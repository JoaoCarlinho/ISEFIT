<<<<<<< HEAD
<?php
         include('header.php');
         include('session.php');
=======
<html>
    <center><div>
        <?php
>>>>>>> 297478587b120b121a1bd94d40953e29eea03024
        require_once('connect.php');
    /*** This page will search for workouts already completed for current client and list******/
        $db = connect();
        $clientID = $_SESSION['clientID'];
<<<<<<< HEAD
        $today = date("Y-m-d");
        $view = 'past';
                                            /**Query workouts for current client***********/
                $query = $db->prepare("SELECT workoutID, createDate, adaptation, focus, completeDate
                                        FROM workouts 
                                        WHERE clientID = '$clientID' AND completeDate < '$today'") or die("could not query workoutBasket");
=======
                                            /**Query workouts for current client***********/
                $query = $db->prepare("SELECT workoutID, createDate, adaptation, focus, datePlanned
                                        FROM workouts 
                                        WHERE clientID = '$clientID' AND datePlanned < CURRENT_DATE()") or die("could not query workoutBasket");
>>>>>>> 297478587b120b121a1bd94d40953e29eea03024
                $query->execute();
                $row = $query->fetchAll(PDO::FETCH_ASSOC);
                $count = count($row);
                
        if($count > 0){
            $list = array();
            /*table of workouts with buttonLInk for workoutID**/
            foreach($row as $info){
    	        //put workouts into a list for display
<<<<<<< HEAD
    	            $creator['workoutID']=$info['workoutID'];
    	            $creator['createDate']=$info['createDate'];
            	    $creator['adaptation']=$info['adaptation'];
                    $creator['focus']=$info['focus'];
                    $creator['completeDate']=$info['completeDate'];
=======
    	            $creator[0]=$info['workoutID'];
    	            $creator[1]=$info['createDate'];
            	    $creator[2]=$info['adaptation'];
                    $creator[3]=$info['focus'];
                    $creator[4]=$info['datePlanned'];
>>>>>>> 297478587b120b121a1bd94d40953e29eea03024

    	            $list[]=$creator;
                 }
                 /***********display list in an html table*********************/
<<<<<<< HEAD
            include('pastWorkoutTableView.php');
        }else{
            echo $userName.' has not completed any workouts';
        }
?>
=======
            include('navPastWorkoutTableView.php');
        }
?>
    </div></center>
</html>
>>>>>>> 297478587b120b121a1bd94d40953e29eea03024
