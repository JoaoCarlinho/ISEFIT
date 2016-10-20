<html>
    <center><div>
        <?php
    /*** This page will search for workouts already planned for current client and list them along with button to create new workout******/
        $db = connect();
        $query = $db->prepare("SELECT trainerID
                                        FROM trainers 
                                        WHERE email = '$username'") or die("could not query workoutBasket");
                $query->execute();
                $row = $query->fetchAll(PDO::FETCH_ASSOC);
                $count = count($row);
                
        if($count > 0){
            foreach($row as $info){
    	            $trainerID = $info['trainerID'];
            }
        }else{
            header("Location: clientRegistration.php?message=$message");
        }
                                            /**Query workouts for current client***********/
                $query = $db->prepare("SELECT nickName, clientID
                                        FROM clients 
                                        WHERE currentTrainerID = '$trainerID'") or die("could not query workoutBasket");
                $query->execute();
                $row = $query->fetchAll(PDO::FETCH_ASSOC);
                $count = count($row);
                
        if($count > 0){
            $list = array();
            /*table of clients with buttonLInk for workouts**/
            foreach($row as $info){
    	        //put workouts into a list for display
    	            $creator[0]=$info['nickName'];
    	            $creator[1]=$info['clientID'];
    	            $list[]=$creator;
                 }
                 /***********display list in an html table*********************/
            include('navClientTableView.php');
        }
        /** Next include table of workout requests by date created **/
        ?>
    </div></center>
</html>