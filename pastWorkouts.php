<html>
    <center><div>
        <?php
        require_once('connect.php');
    /*** This page will search for workouts already completed for current client and list******/
        $db = connect();
        $clientID = $_SESSION['clientID'];
                                            /**Query workouts for current client***********/
                $query = $db->prepare("SELECT workoutID, createDate, adaptation, focus, datePlanned
                                        FROM workouts 
                                        WHERE clientID = '$clientID' AND datePlanned < CURRENT_DATE()") or die("could not query workoutBasket");
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
            include('navPastWorkoutTableView.php');
        }
?>
    </div></center>
</html>
