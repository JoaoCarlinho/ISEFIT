<?php
include('connect.php');
session_start();
$db = connect();

//storeWorkout.php
//This take the exBlob from buildWorkout.php for the current client and add to workouts table 
    if(isset($_POST['blob'])  && isset($_POST['adaptation']) && isset($_POST['focus'])&& isset($_POST['completion']) && isset($_SESSION['clientID'])){
        $exBlob = $_POST['blob'];
        $adapt = $_POST['adaptation'];
        $focus = $_POST['focus'];
        $completion = $_POST['completion'];
        $clientID = $_SESSION['clientID'];
        $exMap = array();
        $createDate = date('Y-m-d H:i:s');
        
        /** update workouts table for current date with workout sent from workoutList.php**************************************
        notes:
            workouts created by non-trainers can only be independent, so that means modeID will be 3 unless $_SESSION['trainerID'] is set
            default adaptation is weight-loss, will create a dropdown for adjustment to send along with exBlob
            **/
        if($completion == 1){
            if(isset($_POST['completeDate'])){
                $completeDate = $_POST['completeDate'];
                $query = $db->prepare("INSERT INTO workouts (createDate, clientID, adaptationID, focusID, exBlob, completeDate, completed) VALUES(?, ?, ?, ?, ?, ?)") or die("could not search");
                $query->execute(array($createDate, $clientID, $adapt, $focus, $exBlob,$completeDate, $completion));
                echo 'workout stored';
            }else{
                echo'must enter completion date to stored completed workout';
            }
        }else{
            $query = $db->prepare("INSERT INTO workouts (createDate, clientID, adaptationID, focusID, exBlob, completed) VALUES(?, ?, ?, ?, ?, ?)") or die("could not search");
            $query->execute(array($createDate, $clientID, $adapt, $focus, $exBlob, 0));
            echo 'workout stored';
        }
        /**create hashMap called exMap from exBlob**/
        /**start by finding number of exercises and store as length of hash
        Use regex matching to count occurences of 'ex' in exBlob and set that to length of hash**/
        
        
        
        /** store exID as first element in each sub-array of hashmap  **/
        
        /**store exTypeID as second element in each sub-array of hashmap.  This determines number of columns and headers to be created(2 or 3)**/
        /**pull number of sets for each exercise.  This determines number of rows for each exercise  **/
        
        
        
        /** pull exercises in workoutBasket for current client so they can be removed once the workout is stored *******************
        $query = $db->prepare("SELECT clientID, exID, setCount FROM workoutBasket WHERE clientID = '$clientID'") or die("could not query workoutBasket");
        $query->execute();
        $row = $query->fetchAll(PDO::FETCH_ASSOC);
        $count = count($row);
        if($count > 0){
            echo('found exercises');
            foreach($row as $info){
	        //put exercises into a basket for use today 
	            $blob=$info['exBlob'];
             }
        }else{
            echo('user has no workoutBasket');
        }**/
        
    }
    
    
    
    
    
    /************************************exInserter code for example of inserting SQL code
     * 
     * 
     if(isset($_SESSION['clientID'])  && isset($_GET['exercise']) && isset($_GET['setCount'])){
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
        
                //Query workoutBasket for current client**************************************************************************
                $query = $db->prepare("SELECT clientID, exID, setCount FROM workoutBasket WHERE clientID = '$clientID'") or die("could not query workoutBasket");
                $query->execute();
                $row = $query->fetchAll(PDO::FETCH_ASSOC);
                $count = count($row);
                if($count > 15){
                    $overflow = 1;
                    echo "That's enough exercises for one workout"
                }else if($count > 0){             //user has an active basket to compare with*******************************************************************
                    $basket = array();      //Put user's active basket into an array****************************************************************************
                    foreach($row as $info){     
                    //put items into a basket for comparison****************************************************************************   
                        $creator[0]=$info['clientID'];
                        $creator[1]=$info['exID'];
                        $creator[2]=$info['setCount'];
                        $basket[]=$creator;                  
                     }
                    //determine if the basket already has a exercise with same exName inside****************************************************************************
            	    $index = -1;
            	    for($line=0; $line<count($basket); $line++){
            	        if($basket[$line][1]==$exID){
            	            $index = 0;
            	            $repeat = 1;
            	            echo 'this exercise is already queued up';
            	        }
            	    }
            	    if($index==-1){   //make new row in workoutBasket since no exercise currently in cart with same exID*****************************************
                	        $query = $db->prepare("INSERT INTO workoutBasket (clientID, exID, setCount) VALUES(?, ?, ?)") or die("could not search");
                            $query->execute(array($clientID, $exID, $setCount));
                            $inserted = 1;
                            echo 'inserting exercise';
                    }
                //add an exercise to an empty basket *******************************************************************************************************************
                }else if($count == 0){
                    $inserted = 1;
                    echo 'creating new basket<br/>';
                    //add first line to cart*****************************************************************************************************************************
                    $query = $db->prepare("INSERT INTO workoutBasket (clientID, exID, setCount) VALUES(?, ?, ?)") or die("could not search");
                    $query->execute(array($clientID, $exID, $setCount));
                }
    }
}
?>
     
     
     ***/

?>

