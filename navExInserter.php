<?php
/***************************This page updates the workoutBasket when an exercise is added or removed from exSelector**********/

session_start();
require_once('connect.php');
$db = connect();

/** handle request for removal of exercise from a workout**********/
        //will need to make more of these for cases where person has not registered
        if(isset($_GET['index'])  && isset($_GET['exName']) && isset($_GET['workoutID'])){
                //remove exercise from array and workout basket in database
                $sql =("DELETE FROM workoutBasket WHERE exID = ? AND clientID = ? and workoutID = ?");
                $stmt = $db->prepare($sql);
                $stmt->execute(array($_GET['exID'], $_SESSION['clientID'], $_GET['workout']));
                
                //Put cart into an array
                $basket = array();
                $creator = array();
                $query = $db->prepare("SELECT exercises.exID, exercises.exName, workoutBasket.setCount 
                                        FROM exercises 
                                        INNER JOIN workoutBasket 
                                        ON exercises.exID = workoutBasket.exID 
                                        WHERE workoutBasket.clientID = '$clientID'") or die("could not query workoutBasket");
                $query->execute();
                $row = $query->fetchAll(PDO::FETCH_ASSOC);
                //read each returned item's info
                 foreach($row as $info){
    	        //put exercises into a basket for use today 
    	            $creator[0] = $info['exName'];
    	            $creator[1] = $info['setCount'];
    	            $creator[2] = $info['exiD'];
    	            $basket[] = $creator;
                 }
                 include('exTableView.php');
        }

/*** handle request for addition of new exercises to a workout**************/

if(isset($_SESSION['clientID'])  && isset($_POST['exID']) && isset($_POST['setCount'])  && isset($_POST['adaptID'])  && isset($_POST['workoutID'])){
    $exercise = $_POST['exID'];
    $clientID = $_SESSION['clientID'];
    $setCount = $_POST['setCount'];
    $adaptID = $_POST['adaptID'];
    include('getAdaptName.php');
    $workoutID = $_POST['workoutID'];
    /***************************Retrieve adaptationID based on adaptName passed**************************************************/
    $query = $db->prepare("SELECT adaptationID FROM adaptations WHERE adaptName = '$adaptName'") or die("could not search");
    $query->execute();
    $result = $query->fetchAll(PDO::FETCH_ASSOC);
    $countEx = count($result);
    if($countEx == 0){
        echo('no adaptation named '.$adaptName);
    }else{
        foreach($result as $info){
            $adaptationID = $info['adaptationID'];  
        }
    }
    
    //***************************Retrieve exID from database for comparison to existing exercise in client's workoutBasket**************************************        
    $query = $db->prepare("SELECT exID FROM exercises WHERE exID = '$exercise' LIMIT 1") or die("could not search");
    $query->execute();
    $result = $query->fetchAll(PDO::FETCH_ASSOC);
    $countEX = count($result);
    if($countEX > 0){ //valid exercise name entered
        foreach($result as $info){
            $exID = $info['exID'];
        }

        /**Query workoutBasket for current client**************************************************************************/
        
        $query = $db->prepare("SELECT workoutBasket.exID, workoutBasket.setCount, workoutBasket.adaptationID
                                FROM workoutBasket 
                                INNER JOIN workouts 
                                ON workouts.workoutID = workoutBasket.workoutID 
                                WHERE workouts.workoutID ='$workoutID' AND workouts.clientID = '$clientID'") or die("could not query workoutBasket");
        $query->execute();
        $row = $query->fetchAll(PDO::FETCH_ASSOC);
        $count = count($row);
        if($count > 0){             //user has an active basket to compare exercises*******************************************************************
            $basket = array();      //Put user's active basket into an array****************************************************************************
                foreach($row as $info){     
                //put items into a basket for comparison****************************************************************************

                    $creator[1] = $info['exID'];
                    $creator[2] = $info['setCount'];
                    $creator[3] =  $info['adaptationID'];
                    $creator[4] = $workoutID ;
                    $basket[] = $creator;                  
                 }
            //determine if the basket already has a exercise with same exID inside****************************************************************************
    	    $index = -1;
    	    $repeatSets = 0;
    	    for($line=0; $line<count($basket); $line++){
    	        if($basket[$line][1] == $exID ){
    	            $index = 0;
    	            $repeatSets += 1;
    	        }
    	    }
    	    if($index == -1){   //make new row in workoutBasket since no exercise currently in cart with same exID*****************************************
                for($x=1; $x<=$setCount; $x++){
        	       $query = $db->prepare("INSERT INTO workoutBasket ( exID, setCount, workoutID, setIndex, adaptationID) VALUES(?, ?, ?, ?, ?)") or die("could not search");
                    $query->execute(array($exID, $setCount, $workoutID, $x, $adaptationID));
  
                    $inserted = 1;
                    $message = 'adding '.$setCount.' sets of Ex#'.$exercise.' to the list';
                }
            }else if(index == 0){
                /********************note changes to set count and adaptation ID for any updates to exercises already in basket**********************/
                            $query = $db->prepare("SELECT adaptName FROM adaptations WHERE adaptationID = '$oldAdaptation'") or die("could not search");
                            $query->execute();
                            $result = $query->fetchAll(PDO::FETCH_ASSOC);
                            $countEX = count($result);
                if(count == 1){
                    foreach($result as $info){
                        $oldAdapt = $info['adaptation'];  
                    }

                
                $message = 'Exercise previously marked as '.$oldAdapt.' exercise for '.$repeatSets.' sets.  But now it is adjusted to '.$setCount.' sets for '.$adaptName;
                    for($x=1; $x<=$setCount; $x++){
                        $sql = "UPDATE 'workoutBasket'   
                            SET 'workoutID' = :workoutID,
                            'exID' = :exID,
                            'setCount` = :setCount,
                            'setIndex' = :setIndex
                            adaptationID = :adaptationID
                            WHERE `workoutID ` = :workoutID AND 'setCount' = :setCount;";
                        
                        
                         $statement = $db->prepare($sql);
                         $statement->bindValue(":workoutID", $workoutID);
                         $statement->bindValue(":exID", $currentEx);
                         $statement->bindValue(":setCount", $setCount);
                         $statement->bindValue(":setIndex", $x);
                         $statement->bindValue(":adaptationID", $adaptationID);
                         $count = $statement->execute();
                    }
                    $inserted = 1;
                }
            }
        //add an exercise to an empty basket *******************************************************************************************************************
        }else if($count == 0){
            $inserted = 1;
            $message = 'creating new basket<br/>';
            
            for($x=1; $x<=$setCount; $x++){
                //add lines to workoutBasket*****************************************************************************************************************************
                $query = $db->prepare("INSERT INTO workoutBasket ( exID, setCount, workoutID, setIndex, adaptationID) VALUES(?, ?, ?, ?, ?)") or die("could not search");
                $query->execute(array($exID, $setCount, $workoutID, $x, $adaptationID));
            }
        }
    }
    echo $message;
    
}elseif(isset($_SESSION['trainer'])  && isset($_POST['exID']) && isset($_POST['setCount'])  && isset($_POST['adaptID'])  && isset($_POST['workoutID'])){

    $exercise = $_POST['exID'];
    $setCount = $_POST['setCount'];
    $adaptID = $_POST['adaptID'];
    include('getAdaptName.php');
    $workoutID = $_POST['workoutID'];
    
    //***************************Retrieve exID from database for comparison to existing exercise in client's workoutBasket**************************************        
    $query = $db->prepare("SELECT exID FROM exercises WHERE exID = '$exercise' LIMIT 1") or die("could not search");
    $query->execute();
    $result = $query->fetchAll(PDO::FETCH_ASSOC);
    $countEX = count($result);
    if($countEX > 0){ //valid exercise name entered
        foreach($result as $info){
            $exID = $info['exID'];
        }

        /**Query workoutBasket for current client**************************************************************************/
        
        $query = $db->prepare("SELECT workoutBasket.exID, workoutBasket.setCount, workoutBasket.adaptationID
                                FROM workoutBasket 
                                INNER JOIN workouts 
                                ON workouts.workoutID = workoutBasket.workoutID 
                                WHERE workouts.workoutID ='$workoutID' AND workouts.clientID = '$clientID'") or die("could not query workoutBasket");
        $query->execute();
        $row = $query->fetchAll(PDO::FETCH_ASSOC);
        $count = count($row);
        if($count > 0){             //user has an active basket to compare exercises*******************************************************************
            $basket = array();      //Put user's active basket into an array****************************************************************************
                foreach($row as $info){     
                //put items into a basket for comparison****************************************************************************

                    $creator[1] = $info['exID'];
                    $creator[2] = $info['setCount'];
                    $creator[3] =  $info['adaptationID'];
                    $creator[4] = $workoutID;
                    $basket[ ] = $creator;                  
                 }
            //determine if the basket already has an exercise with same exID inside****************************************************************************
    	    $index = -1;
    	    $repeatSets = 0;
    	    for($line=0; $line<count($basket); $line++){
    	        if($basket[$line][1] == $exID ){
    	            $index = 0;
    	            $repeatSets += 1;
    	            $repeatLine = $line;
    	        }
    	    }
    	    if($index==-1){   //make new row in workoutBasket since no exercise currently in cart with same exID*****************************************
                for($x=1; $x<=$setCount; $x++){
        	       $query = $db->prepare("INSERT INTO workoutBasket ( exID, setCount, workoutID, setIndex, adaptationID) VALUES(?, ?, ?, ?, ?)") or die("could not search");
                    $query->execute(array($exID, $setCount, $workoutID, $x, $adaptationID));
  
                    $inserted = 1;
                    $message = 'adding '.$setCount.' sets of Ex#'.$exercise.' to the list';
                }
            }else if(index == 0){
                echo('repeated exercise found');
                /********************note changes to set count and adaptation ID for any updates to exercises already in basket**********************/
                    $oldAdaptationID = $basket[$repeatLine][3];
                    $currentEx = $basket[$repeatLine][1];
                    $query = $db->prepare("SELECT adaptName FROM adaptations WHERE adaptationID = '$oldAdaptationID'") or die("could not search");
                    $query->execute();
                    $result = $query->fetchAll(PDO::FETCH_ASSOC);
                    $count = count($result);
                if($count == 1){
                    foreach($result as $info){
                        $oldAdapt = $info['adaptName'];  
                    }

                
                echo  'Exercise previously marked as '.$oldAdapt.' exercise for '.$repeatSets.' sets.  But now it is adjusted to '.$setCount.' sets for '.$adaptName;
                       try {
                                // sql to delete a record
                                $sql = "DELETE FROM workoutBasket WHERE exID = '$exID'";
                            
                                // use exec() because no results are returned
                                $db->exec($sql);
                                echo "Record deleted successfully";
                            }
                        catch(PDOException $e)
                            {
                                echo $sql . "<br>" . $e->getMessage();
                            }

                       
                        for($x=1; $x<=$setCount; $x++){
                            //add lines to workoutBasket*****************************************************************************************************************************
                            $query = $db->prepare("INSERT INTO workoutBasket ( exID, setCount, workoutID, setIndex, adaptationID) VALUES(?, ?, ?, ?, ?)") or die("could not search");
                            $query->execute(array($exID, $setCount, $workoutID, $x, $adaptationID));
                        }
                    $inserted = 1;
                }
            }
        //add an exercise to an empty basket *******************************************************************************************************************
        }else if($count == 0){
            $inserted = 1;
            $message = 'creating new basket<br/>';
            
            for($x=1; $x<=$setCount; $x++){
                //add lines to workoutBasket*****************************************************************************************************************************
                $query = $db->prepare("INSERT INTO workoutBasket ( exID, setCount, workoutID, setIndex, adaptationID) VALUES(?, ?, ?, ?, ?)") or die("could not search");
                $query->execute(array($exID, $setCount, $workoutID, $x, $adaptID));
            }
        }
    }
    echo $message;
    
    
}
?>