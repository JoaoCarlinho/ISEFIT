<?php   

include('session.php');

if(isset($_POST['store']) && isset($_POST['workoutID']) && isset($_POST['completeDate']) && isset($_POST['mode'])){
    
    $mode = $_POST['mode'];
    $completeDate = $_POST['completeDate'];
    date_default_timezone_set('America/New_York');
    $today = date("Y-m-d");

    $db = connect();
    $workoutID = $_POST['workoutID'];
    /***********************check for completion or planning for future date*************************/
            if($completeDate == ''){
                header("Location:navWorkoutPlanner.php?workoutID='$workoutID'");
            }elseif($completeDate > $today){
/******************make sure workout was completed today or on a past date before marking complete*****************/
                $message = 'select today or day in past for completion date';
                header("Location: navIndex.php?messge='$message'");
            }else{
?>
                <script type='text/javascript'>
                var completeDate = <?php echo json_encode($completeDate); ?>;
                    
                    alert('Workout completed on '+ completeDate);</script>
<?php
                $sql = "UPDATE workouts   
                SET completeDate = '$completeDate'
                WHERE workoutID = '$workoutID'";
                
                $statement = $db->prepare($sql);
                $store = $statement->execute();
            }
        
}else{
    header("Location: navIndex.php");
}
    
    /**foreach ($_POST as $name => $val)
{
     echo htmlspecialchars($name . ': ' . $val) . "\n";
}**/
                           
    /************************pull all info from workout table************************************************/
                $query = $db->prepare("SELECT adaptation, modeID, focus, datePlanned
                            FROM workouts
                            WHERE workoutID = '$workoutID'") or die("could not query workoutBasket");
                $query->execute();
                $row = $query->fetchAll(PDO::FETCH_ASSOC);
                $count = count($row);
                if($count == 1){
                    foreach($row as $info){
                        $adaptation = $info['adaptation'];
                        $modeID = $info['modeID'];
                        $focus = $info['focus'];
                        $workoutDate = $info['datePlanned'];
                    }
/****************************workout exists, so pull info from workoutBasket for this workout if there is any**********/
                    $query = $db->prepare("SELECT exID
                                FROM workoutBasket
                                WHERE workoutID = '$workoutID'") or die("could not query workoutBasket");
                    $query->execute();
                    $row = $query->fetchAll(PDO::FETCH_ASSOC);
                    $basketCount = count($row);
                }
                
        if($basketCount > 0){        
            $basket = array();
            $query = $db->prepare("SELECT workoutBasket.exID, workoutBasket.setIndex, workoutBasket.setCount, workoutBasket.durationMade, workoutBasket.repsMade, workoutBasket.weightMade, workoutBasket.adaptationID, exercises.exName, exercises.exTypeID
                                    FROM workoutBasket
                                    INNER JOIN exercises ON workoutBasket.exID = exercises.exID
                                    WHERE workoutBasket.workoutID = '$workoutID' ORDER BY exID ASC, setIndex ASC") or die("could not query workoutBasket");        
            $query->execute();
            $row = $query->fetchAll(PDO::FETCH_ASSOC);
            $count = count($row);
            if($count > 0){
                foreach($row as $info){
    	        //put exercises into a basket for use today 
    	            $exercise[0]=$info['exName'];
    	            $exercise[1]=$info['exTypeID'];
    	            $exercise[2]=$info['setIndex'];
    	            $exercise[3]=$info['exID'];
    	            $exercise[4]=$info['durationMade'];
    	            $exercise[5]=$info['repsMade'];
    	            $exercise[6]=$info['weightMade'];
    	            $exercise[7]=$info['setCount'];
    	            $exercise[8]=$info['adaptationID'];
    	            $basket[]=$exercise;
                 }
            }
            $db = null;
        }
include('navStoredWorkoutView.php');
   
   /** 
    
    if(isset($_POST['basket'])){
        $workoutPlan = json_decode(stripslashes($_POST['workoutPlan']), true);
        
        echo count($workoutPlan);
    }
    
    **/
    
?>