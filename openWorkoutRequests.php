<?php   
$logged = $_SESSION['logged'];
$clientID = $_SESSION['clientID'];

if($logged == 1){
    
    /*****************************************Show profile workout requests that have not yet been filled*********************************/
    $db = connect();
    $query = $db->prepare("SELECT requestID, trainerID, requestSLADate, modeID, requestExecDate, adaptationID, focusID 
                           FROM workoutRequests 
                           WHERE clientID = '$clientID' AND filled = 0") or die("could not check member");
    $query->execute();
    $result = $query->fetchAll(PDO::FETCH_ASSOC);
    $count = count($result);
    $creator = array();
    $list = array();
    if($count > 0){
        foreach($result as $info){
            $creator[0] = $info['requestID'];
            $creator[1] = $info['trainerID'];
            $creator[2] = $info['requestSLADate'];
            $creator[3] = $info['modeID'];
            $creator[4] = $info['requestSLADate'];
            $creator[5] = $info['adaptationID'];
            $creator[6] = $info['focusID'];

            $list[] = $creator;
        }
        include('openWorkoutRequestTableView.php');
    }else{ ?>
       <p><center>no open workout requests</center></p>
<?php   }
}


?>