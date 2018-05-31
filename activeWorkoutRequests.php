<?php
$trainer = $_SESSION['trainer'];
$trainerID = $_SESSION['trainerID'];

if($logged == 1){
    
    /*****************************************Show profile image and stats*********************************/
    /**************************************Show up to last 3 completed workouts with pagination for any further workouts*****************************/
    /******************Show next workout to be completed along with the intended completion date ***********************************/    
    $db = connect();
    $query = $db->prepare("SELECT requestID, clientID, requestSLADate, modeID 
                           FROM workoutRequests 
                           WHERE trainerID = '$trainerID' AND filled = 0") or die("could not check member");
    $query->execute();
    $result = $query->fetchAll(PDO::FETCH_ASSOC);
    $count = count($result);
    $creator = array();
    $list = array();
    if($count > 0){
        foreach($result as $info){
            $creator[0] = $info['requestID'];
            $creator[1] = $info['clientID'];
            $creator[2] = $info['requestSLADate'];
            $creator[3] = $info['modeID'];
            $list[] = $creator;
        }
    }
}

include('activeWorkoutRequestTableView.php');
?>