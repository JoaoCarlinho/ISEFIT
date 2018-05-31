<?php
         include('header.php');
         include('session.php');
        require_once('connect.php');
    /*** This page will search for workouts already completed for current client and list******/
        $db = connect();
        $clientID = $_SESSION['clientID'];
        $today = date("Y-m-d");
        $view = 'past';
                                            /**Query workouts for current client***********/
                $query = $db->prepare("SELECT workoutID, createDate, adaptation, focus, completeDate
                                        FROM workouts 
                                        WHERE clientID = '$clientID' AND completeDate < '$today'") or die("could not query workoutBasket");
                $query->execute();
                $row = $query->fetchAll(PDO::FETCH_ASSOC);
                $count = count($row);
                
        if($count > 0){
            $list = array();
            /*table of workouts with buttonLInk for workoutID**/
            foreach($row as $info){
    	        //put workouts into a list for display
    	            $creator['workoutID']=$info['workoutID'];
    	            $creator['createDate']=$info['createDate'];
            	    $creator['adaptation']=$info['adaptation'];
                    $creator['focus']=$info['focus'];
                    $creator['completeDate']=$info['completeDate'];

    	            $list[]=$creator;
                 }
                 /***********display list in an html table*********************/
            include('pastWorkoutTableView.php');
        }else{
            echo $userName.' has not completed any workouts';
        }
?>
