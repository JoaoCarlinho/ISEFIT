<html>
    <center><div>
        <?php
    /*** This page will search for workouts already planned for current client and list them along with button to create new workout******/
        $db = connect();
        $clientID = $_SESSION['clientID'];
                                            /**Query workouts for current client***********/
                $query = $db->prepare("SELECT workoutID, createDate, adaptation, focus, datePlanned
                                        FROM workouts 
                                        WHERE clientID = '$clientID' AND completeDate IS NULL ") or die("could not query workoutBasket");
                $query->execute();
                $row = $query->fetchAll(PDO::FETCH_ASSOC);
                $count = count($row);
                
        if($count > 0){
            $list = array();
            /*table of workouts with buttonLInk for workoutID**/
            foreach($row as $info){
    	        //put workouts into a list for display
    	            $creator[0]=$info['workoutID'];
    	            $creator[1]=$info['createDate'];
    	            $creator[2]=$info['adaptation'];
                    $creator[3]=$info['focus'];
                    $creator[4]=$info['datePlanned'];

    	            $list[]=$creator;
                 }
                 /***********display list in an html table*********************/
            include('navWorkoutTableView.php');
        }
        /** button for new workout plan **/
        ?><a href="navWorkoutCreator.php?newWorkout=1"><p>create new workout</p></a>
    </div></center>
</html>