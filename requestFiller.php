<?php
/** this page will find out which workout ID is assigned to a particular request ID,
    assign workout ID to request if none assigned, 
    and allow addition of exercises to the workouts **********/

/**This page accepts requestID and pulls, client focus and adaptation to assign it to a new workout, or accept workoutID for request which has already begun being filled to update given workout ID 
<<<<<<< HEAD
      A workoutBasket line will be created for each set of each exercise submitted
      **/
=======
      A workoutBasket line will be created for each set of each exercise submitted**/
>>>>>>> 297478587b120b121a1bd94d40953e29eea03024

include('session.php');
$logged = $_SESSION['logged'];
if($logged == 1){
    if(isset($_GET['requestID']) && isset($_SESSION['trainer']) && isset($_SESSION['trainerID'])){
/************************Handle navigation from a trainer's activeWorkoutRequest list *********************************/
        $requestID = $_GET['requestID'];
        
    /****************************************Determine if this requestID is assigned to a workout ID already ***************************************************/    
        $query = $db->prepare("SELECT workoutID 
                                FROM workoutRequests 
                                WHERE requestID = '$requestID'") or die("could not check member");
        $query -> execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        foreach($result as $info){
            $workoutID = $info['workoutID'];
        }
        if($workoutID != 0){
            
    /************************************* workout ID assigned to request already ********************************************/
            $trainerID = $_SESSION['trainerID'];
            $query = $db->prepare("SELECT  workoutID, clientID, requestSLADate, requestExecDate, modeID, focusID, adaptationID FROM workoutRequests WHERE requestID = '$requestID'") or die("could not check member");
            /**********************Need to indclude specific muscles and exercises for Beta 1.1 ****************************/
            $query->execute();
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            $count = count($result);
            $creator = array();
            if($count == 1){
                foreach($result as $info){
                    $workoutID = $info['workoutID'];
                    $clientID = $info['clientID'];
                    $requestSLADate = $info['requestSLADate'];
                    $modeID = $info['modeID'];
                    $focusID = $info['focusID'];
                    $adaptationID = $info['adaptationID'];
                    $datePlanned = $info['requestExecDate'];
                }
            }else{
                header('Location: trainerIndex.php');
            }
            
        }else{
    /******************************* no workoutID assigned to request, so assign one now *******************************************/
            $createDate = date("Y-m-d H:i:s");
            $query = $db->prepare("SELECT MAX(workoutID) AS MaxID FROM workouts") or die("could not query workouts for highest ID");
            $query->execute();
            $row = $query->fetchAll(PDO::FETCH_ASSOC);
            $count = count($row);
            if($count == 1){
                
                foreach($row as $info){
                    $oldMax = $info['MaxID'];
                }
                echo('the old max is: '.$oldMax);  /*** research the result of a max function on an empty table ***********************************/
                $workoutID = $oldMax + 1;
                echo('the new max is: '.$workoutID);
                
            }else{
                echo('error reading max workout ID');
            }
            $query = $db->prepare("SELECT clientID, adaptationID, focusID, requestExecDate 
                                FROM workoutRequests 
                                WHERE requestID = '$requestID'") or die("could not check member");
            $query->execute();
            $row = $query->fetchAll(PDO::FETCH_ASSOC);
            $count = count($row);
            if($count == 1){
                foreach($row as $info){
                    $clientID = $info['clientID'];
                    $adaptID = $info['adaptationID'];
                    $focusID = $info['focusID'];
                    $datePlanned = $info['requestExecDate'];
                }
                include('getAdaptName.php');
                include('getFocusArea.php');
            }else{
                header('Location: trainerIndex.php');
            }
    
    /*********************update workouts table with new workout for client************************************************************************/       
            $query = $db->prepare("INSERT INTO workouts (workoutID, createDate, clientID, adaptation, focus, datePlanned, trainerCreator) VALUES(?, ?, ?, ?, ?, ?, ?)") or die("could not search");
            $query->execute(array($workoutID, $createDate, $clientID, $adaptName, $focusArea, $datePlanned, 1));
        
    /*********************update workoutRequests table with new workoutID for requestID************************************************************************/       
            $sql="UPDATE workoutRequests   
                  SET workoutID = :workoutID
                  WHERE requestID = :requestID;";
                        
                        
                         $statement = $db->prepare($sql);
                         $statement->bindValue(":workoutID", $workoutID);
                         $statement->bindValue(":requestID", $requestID);
                         $count = $statement->execute();
        }
        include('requestFillerTableView.php');    
    
    }elseif(isset($_POST['workoutID'])  && isset($_POST['adaptID']) && isset($_POST['exID']) && isset($_POST['setCount'])){
/************************Handle addition of an exercise workoutBasket *********************************/
        $workoutID = $_POST['workoutID'];
        $exID = $_POST['exID'];
        $adaptID = $_POST['adaptID'];
        $setCount = $_POST['setCount'];
        include('workoutEditAuth.php');
        /**** Put together info for requestFiller table View ************************************/
         $trainerID = $_SESSION['trainerID'];
            $query = $db->prepare("SELECT  requestID, clientID, requestSLADate, requestExecDate, modeID, focusID, adaptationID 
                                    FROM workoutRequests 
                                    WHERE workoutID = '$workoutID'") or die("could not check member");
            /**********************Need to indclude specific muscles and exercises for Beta 1.1 ****************************/
            $query->execute();
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            $count = count($result);
            $creator = array();
            if($count == 1){
                foreach($result as $info){
                    $requestID = $info['requestID'];
                    $clientID = $info['clientID'];
                    $requestSLADate = $info['requestSLADate'];
                    $modeID = $info['modeID'];
                    $focusID = $info['focusID'];
                    $adaptationID = $info['adaptationID'];
                    $datePlanned = $info['requestExecDate'];
                }
            }
        
<<<<<<< HEAD
        //Make sure to send email to client as well as trainer with table of assigned values
=======
        
>>>>>>> 297478587b120b121a1bd94d40953e29eea03024
        include('navExInserter.php');
        include('requestFillerTableView.php');
    }else{
        header('Location: trainerIndex.php');
    }
}else{
    header('Location: logout.php');
}




?>
