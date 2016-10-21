<?php
/***************************This page updates the workoutBasket when an exercise is added or removed from exSelector**********/
session_start();
$db = connect();

/** handle request for removal of exercise from a workout**********/
        //will need to make more of these for cases where person has not registered
        if(isset($_GET['index'])  && isset($_GET['exID']) && isset($_GET['workoutID']) && isset($_SESSION['clientID'])){
                
                //remove exercise from array and workout basket in database
                $sql =("DELETE FROM workoutBasket 
                WHERE exID = ? AND workoutID = ?");
                $stmt = $db->prepare($sql);
                $stmt->execute(array($_GET['exID'], $_GET['workoutID']));
                
                $deleteMessage = 'exercise removed from workout';
                                echo "<script type='text/javascript'>alert('$deleteMessage');</script>";
        }

/*** handle request for addition of new exercises to a workout**************/

if(isset($_SESSION['clientID'])  && isset($_POST['exID']) && isset($_POST['setCount'])  && isset($_POST['adaptID'])  && isset($_POST['workoutID'])){
    $exercise = $_POST['exID'];
    $clientID = $_SESSION['clientID'];
    $setCount = $_POST['setCount'];
    $adaptID = $_POST['adaptID'];
    $adaptName = getAdaptName($adaptID);
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

        /**Query workoutBasket for current client with current workoutID**************************************************************/
        
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
    	    if($index == -1){
//make new rows in workoutBasket since no exercise currently in cart with same exID*****************************************
                for($x=0; $x<$setCount; $x++){
        	        $query = $db->prepare("INSERT INTO workoutBasket ( exID, setCount, workoutID, setIndex, adaptationID) VALUES(?, ?, ?, ?, ?)") or die("could not search");
                    $query->execute(array($exID, $setCount, $workoutID, $x, $adaptID));
                }
                $inserted = 1;
                    $addMessage = 'adding '.$setCount.' sets of Ex #'.$exercise.' to the list';
                    echo "<script type='text/javascript'>alert('$addMessage');</script>";
                
            }else if(index == 0){
                 $repeatMessage = 'repeated exercise found';
                echo "<script type='text/javascript'>alert('$repeatMessage');</script>";
                /********************note changes to set count and adaptation ID for any updates to exercises already in basket**********************/
                            $query = $db->prepare("SELECT adaptationID FROM workoutBasket WHERE workoutID = '$workoutID' AND exID ='$exercise'") or die("could not search");
                            $query->execute();
                            $result = $query->fetchAll(PDO::FETCH_ASSOC);
                            $countEX = count($result);
                            if($countEX > 0){
                                foreach($result as $info){
                                    $oldAdapt = $info['adaptationID'];  
                                }
                                $oldAdaptName = getAdaptName($oldAdapt);
                
                $updateMessage = 'Exercise previously marked as '.$oldAdaptName.' exercise for '.$repeatSets.' sets.  But now it is adjusted to '.$setCount.' sets of '.$adaptName;
                echo "<script type='text/javascript'>alert('$updateMessage');</script>";                    
                
                 /********************   Delete old workoutBasket entries and insert new ones *******************/
                                $sql = "DELETE FROM workoutBasket 
                                        WHERE exID = '$exID' AND workoutID = '$workoutID'";
                            
                                // use exec() because no results are returned
                                $db->exec($sql);
                                $deleteMessage = 'Record deleted successfully';
                                echo "<script type='text/javascript'>alert('$deleteMessage');</script>";
                 /********************   Insert new lines into workoutBasket*******************/
                for($x=0; $x<$setCount; $x++){
                    $query = $db->prepare("INSERT INTO workoutBasket ( exID, setCount, workoutID, setIndex, adaptationID) VALUES(?, ?, ?, ?, ?)") or die("could not search");
                    $query->execute(array($exercise, $setCount, $workoutID, $x, $adaptID));
              
                    }
                    $inserted = 1;
                }
            }
        //add an exercise to an empty basket *******************************************************************************************************************
        }else if($count == 0){
            $inserted = 1;
            $message = 'creating new basket';
            echo "<script type='text/javascript'>alert('$message');</script>";
            for($x=0; $x<$setCount; $x++){
                //add lines to workoutBasket*****************************************************************************************************************************
                $query = $db->prepare("INSERT INTO workoutBasket ( exID, setCount, workoutID, setIndex, adaptationID) VALUES(?, ?, ?, ?, ?)") or die("could not search");
                $query->execute(array($exID, $setCount, $workoutID, $x, $adaptID));
            }
            
        }
    }
}elseif(isset($_SESSION['trainer'])  && isset($_POST['exID']) && isset($_POST['setCount'])  && isset($_POST['adaptID'])  && isset($_POST['workoutID'])){

    $exercise = $_POST['exID'];
    $setCount = $_POST['setCount'];
    $adaptID = $_POST['adaptID'];
    $adaptName = getAdaptName($adaptID);
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
                for($x=0; $x<$setCount; $x++){
        	       $query = $db->prepare("INSERT INTO workoutBasket ( exID, setCount, workoutID, setIndex, adaptationID) VALUES(?, ?, ?, ?, ?)") or die("could not search");
                    $query->execute(array($exID, $setCount, $workoutID, $x, $adaptID));
                }
                    $inserted = 1;
                    $addMessage = 'adding '.$setCount.' sets of Ex#'.$exercise.' to the list';
                    echo "<script type='text/javascript'>alert('$addMessage');</script>"; 
                  
                    
            }else if(index == 0){
                $repeatMessage = 'repeated exercise found';
                echo "<script type='text/javascript'>alert('$repeatMessage');</script>";
                /********************note changes to set count and adaptation ID for any updates to exercises already in basket**********************/
                    $oldAdaptationID = $basket[$repeatLine][3];
                    $currentEx = $basket[$repeatLine][1];
                    $query = $db->prepare("SELECT adaptationID FROM workoutBasket WHERE workoutID = '$workoutID' AND exID = '$exID'") or die("could not search");
                    $query->execute();
                    $result = $query->fetchAll(PDO::FETCH_ASSOC);
                    $count = count($result);
                if($count == 1){
                    foreach($result as $info){
                        $oldAdapt = $info['adaptationID'];  
                    }
                    $oldAdaptName = getAdaptName($oldAdapt);

                
                $updateMessage =  'Exercise previously marked as '.$oldAdaptName.' exercise for '.$repeatSets.' sets.  But now it is adjusted to '.$setCount.' sets of '.$adaptName;
                echo "<script type='text/javascript'>alert('$updateMessage');</script>";       
                       
 /********************   Delete old workoutBasket entries and insert new ones *******************/
                                $sql = "DELETE FROM workoutBasket 
                                WHERE exID = '$exID' AND workoutID = '$workoutID'";
                            
                                // use exec() because no results are returned
                                $db->exec($sql);
                                $deleteMessage = 'Record deleted successfully';
                                echo "<script type='text/javascript'>alert('$deleteMessage');</script>";

  /*************************Insert new workoutBasket entries******************************************/                     
                        for($x=0; $x<$setCount; $x++){
                    $query = $db->prepare("INSERT INTO workoutBasket ( exID, setCount, workoutID, setIndex, adaptationID) VALUES(?, ?, ?, ?, ?)") or die("could not search");
                    $query->execute(array($exercise, $setCount, $workoutID, $x, $adaptID));
                        }
                    $inserted = 1;
                }
                
            }
        ;
        //add an exercise to an empty basket *******************************************************************************************************************
        }else if($count == 0){
            $inserted = 1;
            $message = 'creating new basket';
            
            for($x=1; $x<$setCount; $x++){
                //add lines to workoutBasket*****************************************************************************************************************************
                $query = $db->prepare("INSERT INTO workoutBasket ( exID, setCount, workoutID, setIndex, adaptationID) VALUES(?, ?, ?, ?, ?)") or die("could not search");
                $query->execute(array($exID, $setCount, $workoutID, $x, $adaptID));
            }
           
           
        }
    }
    echo "<script type='text/javascript'>alert('$message');</script>";
}
?>