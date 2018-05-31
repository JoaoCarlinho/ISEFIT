<?php
if (isset($_SESSION['clientID'])){
    if (isset($workoutID)){
        $clientID = $_SESSION['clientID'];
        
        $db = connect();
        $query = $db->prepare("SELECT workoutID
                               FROM workouts 
                               WHERE clientID = :clientID AND workoutID = :workoutID ") or die("could not check member");
        $query->bindValue(":workoutID", $workoutID);
        $query->bindValue(":clientID", $clientID);
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        $count = count($result);
        if($count == 1){
            /*** User granted authorization to edit workout **/        
        }else{
            /**user cannot view this workout.  send user home and report**/
            $message = 'User does not have edit priveledges for this workout';
            header('Location: navIndex.php?message='.$message);
        }
    }
}elseif(isset($_SESSION['trainer'])){
    if (isset($workoutID)){
        $trainer = $_SESSION['trainer'];
        
        /** determine if trainer is the current Trainer for the client of interest **/
        $query = $db->prepare("SELECT clients.currentTrainerID
                               FROM clients 
                               INNER JOIN workouts ON clients.clientID = workouts.clientID
                               WHERE workouts.workoutID = '$workoutID' AND clients.currentTrainerID = '$trainerID'") or die("could not check member");
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        $count = count($result);
        if($count == 1){
                /** Trainer can edit this client's workouts **/
        }else{
            /**trainer cannot edit this client's workouts.  send user home and report**/
            $message = "User does not have edit priveledges for this client's workouts";
            header('Location: navIndex.php?message='.$message);
        }
    }
}
?>