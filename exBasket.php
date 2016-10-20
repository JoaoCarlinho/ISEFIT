<html>
    <center><div>
        <?php
    /*** This page will update every 5 seconds with any queued up exercises ******/
        $db = connect();
        $clientID = $_SESSION['clientID'];
        /**Query workoutBasket for current client***********/
                $query = $db->prepare("SELECT exercises.exID, exercises.exName, workoutBasket.setCount 
                                        FROM exercises 
                                        INNER JOIN workoutBasket ON exercises.exID = workoutBasket.exID
                                        INNER JOIN workouts ON 
                                        workoutBasket.workoutID = workouts.workoutID
                                        WHERE workouts.clientID = '$clientID' AND workouts.basketStatus=0 ") or die("could not query workoutBasket");
                $query->execute();
                $row = $query->fetchAll(PDO::FETCH_ASSOC);
                $count = count($row);
                
        /******************ExSelector.php *****************************/
        //Remove exercises from the workoutBasket at the index from _POST request***************
        //will need to make more of these for cases where person has not registered
        if(isset($_POST['index'])  && isset($_POST['exID'])){
                //remove exercise from array and workout basket in database
                $sql =("DELETE FROM workoutBasket WHERE exID = ? AND clientID = ?");
                $stmt = $db->prepare($sql);
                $stmt->execute(array($_POST['exID'], $_SESSION['clientID']));
                
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
    	            $basket[]=$creator;
                 }
                 include('exTableView.php');
        }
        
        /**********************************attempt to add new exercise to basket *****************/                                 
        if(isset($_POST['newEx'])){
                if($count > 0){
                        //If user has an active basket, put into an array
                        $basket = array();
                        $creator = array();
                        //read each returned item's info
                         foreach($row as $info){     
            	        //put items into a basket for use today    
            	            $creator[0]=$info['exName'];
            	            $creator[1]=$info['setCount'];
    	                    $creator[2]=$exID;
            	            $basket[]=$creator;
                         }
                         
                    //determine if the basket already has a exercise with same exName inside
                    $index = -1;
            	    for($ci=0; $ci<count($basket); $ci++)
            	        if($basket[ci][1]==$_POST['newEx']){
            	            $index=$ci;
            	            break;
            	        }else if($index==-1){
                    //make new row in workoutBasket if no exercise currently in cart with same exName
                        //retrieve product info from database
                        $query = $db->prepare("SELECT exID, exName FROM exercises WHERE exName = ".$_POST['newEx']." LIMT 1") or die("could not search");
                        $query->execute();
                        $result = $query->fetchAll(PDO::FETCH_ASSOC);
                         //loop through retreived info and assign it to variables
                        foreach($result as $info){
            	            $exID=$info['exID'];
            	            $creator[0]=$info['exName'];
            	            $creator[1]=$setCount;
    	                    $creator[2]=$exID;
            	            $basket[]=$creator;
                        }
            	        $query = $db->prepare("INSERT INTO workoutBasket (clientID, exID) VALUES(?, ?)") or die("could not search");
                        $query->execute(array($_SESSION['clientID'], $exID));
        	        }   
                  
                //add an exercise to an empty basket 
                }else if( $count == 0){
                        //Initialize empty cart
                        $basket = array();
                        $creator = array();
                        $query = $db->prepare("SELECT exID,exName FROM exercises WHERE exName = ".$_POST['newEx']) or die("could not search");
                        $query->execute();
                        $result = $query->fetchAll(PDO::FETCH_ASSOC);
                        //loop through retreived info and assign it to variables
                        foreach($result as $info){
                            $exID=$info['exID'];
            	            $creator[0]=$info['exName'];
            	            $creator[1]=$setCount;
            	            $creator[2]=$exID;
            	            $basket[]=$creator;
                        }
                    $_SESSION['basket']=$basket;
                    $query = $db->prepare("INSERT INTO workoutBasket (clientID, exID, setCount) VALUES(?, ?, ?)") or die("could not search");
                    $query->execute(array($_SESSION['clientID'], $exID, $setCount));   
                }
               include('exTableView.php');
        }else{
            /*****************************page load without request for new addition to basket*******/
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
            	            $basket[]=$creator;
                         }
                  
                include('exTableView.php');
                }else{?>
                    <a href='index.php'><input type="submit" value="next workout"/></a>
        <?php }
        }
?>    
    </div></center>
</html>