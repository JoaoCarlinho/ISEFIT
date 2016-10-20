<?php   
$logged = $_SESSION['logged'];
$clientID = $_SESSION['clientID'];

if($logged == 1){
    
    /*****************************************Show profile workout requests that have not yet been filled*********************************/
    $db = connect();
    $query = $db->prepare("SELECT workoutID, adaptation, modeID, focus, datePlanned
                           FROM workouts 
                           WHERE clientID = '$clientID' 
                           AND completeDate IS NULL") or die("could not check member");
    $query->execute();
    $result = $query->fetchAll(PDO::FETCH_ASSOC);
    $count = count($result);
    $creator = array();
    $list = array();
    if($count > 0){
        foreach($result as $info){
            $creator[0] = $info['modeID'];
            $creator[1] = $info['adaptation'];
            $creator[2] = $info['focus'];
            $creator[3] = $info['datePlanned'];
            $creator[4] = $info['workoutID'];
            
            $list[] = $creator;
        }
        include('plannedWorkoutTableView.php');
    }else{ ?>
       <p><center>no planned workouts</center></p>
<?php }
}


?>