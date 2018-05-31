<html>
    <center><div>
        <?php
    /*** This page will update every 5 seconds with any queued up exercises by using the process() function onload******/
        $db = connect();
        /**Query workoutBasket for current client***********/
                $query = $db->prepare("SELECT exercises.exID, exercises.exName, workoutBasket.setCount, workoutBasket.adaptationID
                                        FROM exercises 
                                        INNER JOIN workoutBasket ON exercises.exID = workoutBasket.exID
                                        INNER JOIN workouts ON 
                                        workoutBasket.workoutID = workouts.workoutID
                                        WHERE workouts.clientID = '$clientID' AND workouts.workoutID = '$workoutID'") or die("could not query workoutBasket");
                $query->execute();
                $row = $query->fetchAll(PDO::FETCH_ASSOC);
                $count = count($row);
            /*****************************create workout basket for table display*******/
                if($count > 0){
                        //user has an active basket, put into an array
                        $basket = array();
                        $creator = array();
                        //read each returned item's info
                         foreach($row as $info){     
            	        //put items into a basket for use today    
        	                $exID=$info['exID'];
            	            $creator[0]=$info['exName'];
            	            $creator[1]=$info['setCount'];
            	            $creator[2]=$exID;
            	            $creator[3]=$info['adaptationID'];
            	            $basket[]=$creator;
                         }
                  
                include('navExTableView.php');
                }else{?>
                    <br/>
                    <a href='navWorkoutSelection.php'><input class="createWorkoutButton" type="submit" value="next workout"/></a>
        <?php }
?>    
    </div></center>
</html>