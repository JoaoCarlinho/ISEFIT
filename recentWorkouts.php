<?php
include('connect.php');
session_start();
$db = connect();
/**This file will find all completed workouts for the logged in client and make a paginated table listing....
    Name for the workout, date completed, adaptation, focus area and any milestones set   *******************************/
    if($logged =1){
        $pastWorkouts = array();/** variable for storing workout info retrieved from db  **/
        $clientID = $_SESSION['clientID'];
        /** find all workout for current client in workoutBasket**/
        $query = $db->prepare("SELECT exercises.exName, exercises.exTypeID, workoutBasket.setCount From exercises INNER JOIN workoutBasket ON exercises.exID = workoutBasket.exID WHERE workoutBasket.clientID = '$clientID'") or die("could not query workoutBasket");
        $query->execute();
        $row = $query->fetchAll(PDO::FETCH_ASSOC);
        $count = count($row);
        if($count > 0){
            foreach($row as $info){
	        //put exercises into a basket for use today 
	            $creator[0]=$info['exName'];
	            $creator[1]=$info['exTypeID'];
	            $creator[2]=$info['setCount']
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
