<?php
include('session.php');
if(isset($_GET['workoutID'])){
    $workoutID = $_GET['workoutID'];
    /************************pull all info from workout table, then pull info from workoutBasket for exercises*****************/
                $db = connect();
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
                        $filled = $info['filled'];
                    }
                    
                }
                
        if($filled == 1){        
            $basket = array();
            $query = $db->prepare("SELECT workoutBasket.exID, workoutBasket.setIndex, workoutBasket.setCount, workoutBasket.durationPlan, workoutBasket.repsPlan, workoutBasket.weightPlan, exercises.exName, exercises.exTypeID
                                    FROM workoutBasket
                                    INNER JOIN exercises ON workoutBasket.exID = exercises.exID
                                    WHERE workoutBasket.workoutID = '$workoutID'") or die("could not query workoutBasket");        
            $query->execute();
            $row = $query->fetchAll(PDO::FETCH_ASSOC);
            $count = count($row);
            if($count > 0){
                foreach($row as $info){
    	        //put exercises into a basket for use today 
    	            $creator[0]=$info['exName'];
    	            $creator[1]=$info['exTypeID'];
    	            $creator[2]=$info['setIndex'];
    	            $creator[3]=$info['exID'];
    	            $creator[4]=$info['durationPlan'];
    	            $creator[5]=$info['repsPlan'];
    	            $creator[6]=$info['weightPlan'];
    	            $creator[7]=$info['setCount'];
    	            $basket[]=$creator;
                 }
            }
        }
include('plannedWorkoutDetailView.php');
}
?>




