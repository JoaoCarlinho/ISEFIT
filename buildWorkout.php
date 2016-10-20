<?php
$db = connect();
/**This file will find all open exercises in the workoutBasket for the current client (using session client) and add number of sets to them **/
    if(/**isset($_GET['build'])  &&**/ isset($_SESSION['clientID'])){
        $basket = array();/** variable for storing exBlob in workoutList table  **/
        $clientID = $_SESSION['clientID'];
        /** find all workouts for current client in workoutBasket**/
        $query = $db->prepare("SELECT workoutBasket.workoutID, workoutBasket.exID, workoutBasket.setCount, exercises.exName, exercises.exTypeID
                                From workoutBasket
                                INNER JOIN workouts
                                ON workoutBasket.workoutID = workouts.workoutID
                                WHERE workouts.clientID = '$clientID' AND workouts.basketStatus = 0
                                INNER JOIN exercises ON workoutBasket.exID = exercises.exID") or die("could not query workoutBasket");        
        $query->execute();
        $row = $query->fetchAll(PDO::FETCH_ASSOC);
        $count = count($row);
        if($count > 0){
            foreach($row as $info){
	        //put exercises into a basket for use today 
	            $creator[0]=$info['exName'];
	            $creator[1]=$info['exTypeID'];
	            $creator[2]=$info['setCount'];
	            $creator[3]=$info['exID'];
	            $creator[4]=$info['workoutID'];
	            $basket[]=$creator;
             }
        }else{
            echo('user has no workoutBasket');
        }
        /**show list of exercises for this workout **/
        include('workoutList.php');
        /******* Store client's workouts from basket in workouts table **/
    }
?>
