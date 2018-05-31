<html>
    <center><div>
        <?php
    /*** This page will update every 5 seconds with any queued up exercises by using the process() function onload******/
        $db = connect();
        $clientID = $_SESSION['clientID'];
        /**Query workoutBasket for current client***********/
                $query = $db->prepare("SELECT exercises.exID, exercises.exName, workoutBasket.setCount, workoutBasket.adaptationID
                                        FROM exercises 
                                        INNER JOIN workoutBasket ON exercises.exID = workoutBasket.exID
                                        INNER JOIN workouts ON 
                                        workoutBasket.workoutID = workouts.workoutID
                                        WHERE workouts.clientID = '$clientID' AND workouts.completeDate IS NULL ") or die("could not query workoutBasket");
                $query->execute();
                $row = $query->fetchAll(PDO::FETCH_ASSOC);
                $count = count($row);


        //Remove exercises from the workoutBasket at the index from _POST request***************
        //will need to make more of these for cases where person has not registered
        if(isset($_GET['index'])  && isset($_GET['exID']) && isset($_GET['workoutID'])){
                //remove exercise from array and workout basket in database
                $sql =("DELETE FROM workoutBasket WHERE exID = ? AND clientID = ?");
                $stmt = $db->prepare($sql);
                $stmt->execute(array($_GET['exID'], $_SESSION['clientID']));
                
                //Put cart into an array
                $basket = array();
                $creator = array();
                $query = $db->prepare("SELECT exercises.exID, exercises.exName, workoutBasket.setCount FROM exercises INNER JOIN workoutBasket ON exercises.exID = workoutBasket.exID WHERE workoutBasket.clientID = '$clientID'") or die("could not query workoutBasket");
                $query->execute();
                $row = $query->fetchAll(PDO::FETCH_ASSOC);
                //read each returned item's info
                 foreach($row as $info){
    	        //put exercises into a basket for use today 
    	            $creator[0]=$info['exName'];
    	            $creator[1]=$info['setCount'];
    	            $creator[2]=$info['exiD'];
    	            $creator[3]=$info['adaptationID'];
    	            $basket[]=$creator;
                 }
                 include('navExTableView.php');
        }
        
        else{
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
                    <a href='navWorkoutSelection.php'><input type="submit" value="next workout"/></a>
        <?php }
        }
?>    
    </div></center>
</html>