<?php   

include('session.php');    
/**  set adaptation and focusArea for a workout on this page and send to eXSelector*************/
$db = connect();
/**This file will put exercises from workoutBasket for the workoutID sent in GET into an array **/
    if(isset($_GET['workoutID'])  && isset($_SESSION['clientID'])){
        $workoutID = $_GET['workoutID'];
        include('workoutEditAuth.php');
<<<<<<< HEAD
    /************************pull all info from workout table************************************************/
                $query = $db->prepare("SELECT adaptation, modeID, focus, datePlanned
                            FROM workouts
                            WHERE workoutID = '$workoutID'") or die("could not query workoutBasket");
                $query->execute();
                $row = $query->fetchAll(PDO::FETCH_ASSOC);
                $count = count($row);
                if($count == 1){
                    foreach($row as $info){
                        $adaptation = $info['adaptation'];
                        $modeID = $info['modeID'];
                        $focus = $info['focus'];
                        $workoutDate = $info['datePlanned'];
                    }
/****************************workout exists, so pull info from workoutBasket for this workout if there is any**********/
                    $query = $db->prepare("SELECT exID
                                FROM workoutBasket
                                WHERE workoutID = '$workoutID'") or die("could not query workoutBasket");
                    $query->execute();
                    $row = $query->fetchAll(PDO::FETCH_ASSOC);
                    $filled = count($row);
                }
                
        if($filled > 0){        
            $basket = array();
            $query = $db->prepare("SELECT workoutBasket.exID, workoutBasket.setIndex, workoutBasket.setCount, workoutBasket.durationPlan, workoutBasket.repsPlan, workoutBasket.weightPlan, workoutBasket.adaptationID, exercises.exName, exercises.exTypeID
                                    FROM workoutBasket
                                    INNER JOIN exercises ON workoutBasket.exID = exercises.exID
                                    WHERE workoutBasket.workoutID = '$workoutID' ORDER BY exID ASC, setIndex ASC") or die("could not query workoutBasket");        
=======
        $query = $db->prepare("SELECT filled
                                FROM workouts
                                WHERE workouts.workoutID = '$workoutID'") or die("could not query workoutBasket");        
        $query->execute();
        $row = $query->fetchAll(PDO::FETCH_ASSOC);
        $count = count($row);
        if($count == 1){
            foreach($row as $info){
                $filled = $info['filled'];
            }
            $basket = array();
            $clientID = $_SESSION['clientID'];
            $query = $db->prepare("SELECT workoutBasket.exID, workoutBasket.setCount, workoutBasket.durationPlan, workoutBasket.repsPlan, workoutBasket.weightPlan, exercises.exName, exercises.exTypeID
                                    FROM workoutBasket
                                    INNER JOIN exercises ON workoutBasket.exID = exercises.exID
                                    WHERE workoutBasket.workoutID = '$workoutID'") or die("could not query workoutBasket");        
>>>>>>> 297478587b120b121a1bd94d40953e29eea03024
            $query->execute();
            $row = $query->fetchAll(PDO::FETCH_ASSOC);
            $count = count($row);
            if($count > 0){
                foreach($row as $info){
    	        //put exercises into a basket for use today 
<<<<<<< HEAD
    	            $exercise[0]=$info['exName'];
    	            $exercise[1]=$info['exTypeID'];
    	            $exercise[2]=$info['setIndex'];
    	            $exercise[3]=$info['exID'];
    	            $exercise[4]=$info['durationPlan'];
    	            $exercise[5]=$info['repsPlan'];
    	            $exercise[6]=$info['weightPlan'];
    	            $exercise[7]=$info['setCount'];
    	            $exercise[8]=$info['adaptationID'];
    	            $basket[]=$exercise;
                 }
            }
            
            
            foreach($basket as $exLine){
            $statement = $db->prepare("UPDATE workoutBasket
                                      SET durationMade = :durationMade,
                                          repsMade = :repsMade,
                                          weightMade = :weightMade
                                          WHERE workoutID = :workoutID AND exID = :exID AND setIndex = :setIndex" );
                                        $statement->bindValue(":workoutID", $workoutID);
                                        $statement->bindValue(":durationMade", $exLine[4]);
                                        $statement->bindValue(":repsMade", $exLine[5]);
                                        $statement->bindValue(":weightMade", $exLine[6]);
                                        $statement->bindValue(":exID", $exLine[3]);
                                        $statement->bindValue(":setIndex", $exLine[2]);
                                        $count = $statement->execute();
            }
            
        }
            
            /******* update workoutBasket with repsMade  from basket in workouts table **/
            
    $db = null;    
    }else{
        $db = null;
        header("Location:navIndex.php");
=======
    	            $creator[0]=$info['exName'];
    	            $creator[1]=$info['exTypeID'];
    	            $creator[2]=$info['setCount'];
    	            $creator[3]=$info['exID'];
    	            $creator[4]=$info['workoutID'];
    	            $creator[5]=$info['durationPlan'];
    	            $creator[6]=$info['repsPlan'];
    	            $creator[7]=$info['weightPlan'];
    	            $basket[]=$creator;
                 }
            }else{
                header('Location: navIndex.php');
            }
                            $_SESSION['basket'] = $basket;
    
            /**show list of exercises for this workout **/
            
            /******* Store client's workouts from basket in workouts table **/
        }else{
            $basket = array();
            $clientID = $_SESSION['clientID'];
            $query = $db->prepare("SELECT workoutBasket.exID, workoutBasket.setCount, exercises.exName, exercises.exTypeID
                                    FROM workoutBasket
                                    INNER JOIN exercises ON workoutBasket.exID = exercises.exID
                                    WHERE workoutBasket.workoutID = '$workoutID'") or die("could not query workoutBasket");        
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
                header('Location: navIndex.php');
            }
                            $_SESSION['basket'] = $basket;
    
            /**show list of exercises for this workout **/
            
            /******* Store client's workouts from basket in workouts table **/
        }
>>>>>>> 297478587b120b121a1bd94d40953e29eea03024
    }
?>
<!DOCTYPE html>
<html lang="en-us">
    <?php include('header.php'); ?>
    <body>
        <div class="container">
            <?php /********These are always on the page and used to find out what else to display*******************/
            include('appBar.php'); 
            ?>
 
            <div class = "main">
                <?php 
                        include('navbar.php');
                        
                        include('navWorkoutList.php');
                        
                ?>
            </div>
        </div>
    </body>
</html>
