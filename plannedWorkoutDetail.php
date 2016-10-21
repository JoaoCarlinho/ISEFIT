<?php
include('session.php');
include('getAdaptName.php');
$db = connect();
if(isset($_GET['workoutID'])){
    $workoutID = $_GET['workoutID'];
    /************************pull all info from workout table************************************************/
                $query = $db->prepare("SELECT adaptation, modeID, focus, datePlanned, filled
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
                    $filled = count($row);
                }
                
        if($filled > 0){        
            $basket = array();
            $query = $db->prepare("SELECT workoutBasket.exID, workoutBasket.setIndex, workoutBasket.setCount, workoutBasket.durationPlan, workoutBasket.repsPlan, workoutBasket.weightPlan, workoutBasket.adaptationID, exercises.exName, exercises.exTypeID
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
    	            $exercise[4]=$info['durationPlan'];
    	            $exercise[5]=$info['repsPlan'];
    	            $exercise[6]=$info['weightPlan'];
    	            $exercise[7]=$info['setCount'];
    	            $exercise[8]=$info['adaptationID'];
    	            $basket[]=$exercise;
                 }
            }
            $db = null;
        }
include('plannedWorkoutDetailView.php');
}
?>




