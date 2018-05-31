
<?php
session_start();
require_once('connect.php');
$db = connect();

if(isset($_SESSION['clientID'])  && isset($_GET['exercise']) && isset($_GET['setCount'])  && isset($_GET)){
    $exercise = $_GET['exercise'];
    $clientID = $_SESSION['clientID'];
    $setCount = $_GET['setCount'];
    
    //***************************Retrieve exID from database fo comparison to existing exercise in client's workoutBasket**************************************        
    $query = $db->prepare("SELECT exID FROM exercises WHERE exName = '$exercise' LIMIT 1") or die("could not search");
    $query->execute();
    $result = $query->fetchAll(PDO::FETCH_ASSOC);
    $countEX = count($result);
    if($countEX > 0){ //valid exercise name entered
        foreach($result as $info){
            $exID = $info['exID'];
        }

        /**Query workoutBasket for current client**************************************************************************/
        
        $query = $db->prepare("SELECT workoutBasket.exID, workoutBasket.setCount, workoutBasket.adaptationID, workouts.workoutID, workouts.clientID 
                                FROM workoutBasket innerjoin workouts ON workouts.workoutID = workoutBasket.workoutID 
                                WHERE workouts.basketStatus = 0 AND workouts.clientID = '$clientID'") or die("could not query workoutBasket");
        $query->execute();
        $row = $query->fetchAll(PDO::FETCH_ASSOC);
        $count = count($row);
        if($count >= 15){
            $overflow = 1;
            $message = "That's enough sets for this exercise";
        }else if($count > 0){             //user has an active basket to compare with*******************************************************************
            $basket = array();      //Put user's active basket into an array****************************************************************************
                foreach($row as $info){     
                //put items into a basket for comparison****************************************************************************

                    $creator[1] = $currentEx = $info['exID'];
                    $creator[2]=$info['setCount'];
                    $creator[3]=$info['adaptationID'];
                    $creator[4]= $workoutID = $info['workoutID'];
                    $basket[]=$creator;                  
                 }
            //determine if the basket already has a exercise with same exID inside****************************************************************************
    	    $index = -1;
    	    $repeatSets = 0;
    	    for($line=0; $line<count($basket); $line++){
    	        if($basket[$line][1]==$exID ){
    	            $index = 0;
    	            $repeatSets += 1;
    	        }
    	    }
    	    if($index==-1){   //make new row in workoutBasket since no exercise currently in cart with same exID*****************************************
                for($x=1; $x<=$setCount; $x++){
        	        $query = $db->prepare("INSERT INTO workoutBasket (workoutID, exID, setCount, setIndex) VALUES(?, ?, ?, ?)") or die("could not search");
                    $query->execute(array($workoutID, $currentEx, $setCount, $x));
                    $inserted = 1;
                    $message = 'adding '.$setCount.' sets of Ex#'.$currentEx.' to the list';
                }
            }else if(index == 0){
                $message = 'you had this exercise up for '.$repeatSets.' sets.  But now it is adjusted to '.$setCount.' sets.';
                    for($x=1; $x<=$setCount; $x++){
                        $sql="UPDATE `access_users`   
                       SET `workoutID` = :workoutID,
                           `exID` = :exID,
                           `setCount` = :setCount,
                           `setIndex` = :setIndex 
                        WHERE `workoutID ` = :workoutID;";
                        
                        
                         $statement = $db->prepare($sql);
                         $statement->bindValue(":workoutID", $workoutID);
                         $statement->bindValue(":exID", $currentEx);
                         $statement->bindValue(":setCount", $setCount);
                         $statement->bindValue(":setIndex", $x);
                         $count = $statement->execute();
                    }
                    $inserted = 1;
            }
        //add an exercise to an empty basket *******************************************************************************************************************
        }else if($count == 0){
            $inserted = 1;
            $message = 'creating new basket<br/>';
            $createDate = date('Y-m-d H:i:s');
            /************Query workout table for next number available number in workoutID column in workoutBasket if creating a new workoutBasket
            *********************Reserve this number for current clients workoutID's since they are inserting right now
            (may need to make a transaction) ******************************************************************************************************/
            $maxFinder = $db->prepare("SELECT MAX(workoutID) FROM workouts") or die("could not search");
            $maxFinder->execute();
            $row = $maxFinder->fetchAll(PDO::FETCH_ASSOC);
            $count = count($row);
            if($count == 1){
                foreach($row as $max){
                    $maxWorkoutID = $max;
                }
            }
            $thisWorkoutID = $maxWorkoutID + 1;
            
            $assignWorkout = $db->prepare("INSERT INTO workouts (createDate, clientID) VALUES(?, ?)") or die("could not search");
            $assignWorkout->execute(array($createDate, $clientID));
            for($x=1; $x<=$setCount; $x++){
                //add first line to workoutBasket*****************************************************************************************************************************
                $query = $db->prepare("INSERT INTO workoutBasket ( exID, setCount, workoutID, setIndex) VALUES(?, ?, ?, ? )") or die("could not search");
                $query->execute(array($exID, $setCount, $thisWorkoutID, $x));
            }
        }
    }
}
?>