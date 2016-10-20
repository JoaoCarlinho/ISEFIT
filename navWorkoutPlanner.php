<?php   

include('session.php');    
/**  set adaptation and focusArea for a workout on this page and send to eXSelector*************/
$db = connect();
/**This file will put exercises from workoutBasket for the workoutID sent in GET into an array **/
    if(isset($_GET['workoutID'])  && isset($_SESSION['clientID'])){
        $workoutID = $_GET['workoutID'];
        include('workoutEditAuth.php');
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
                        if($filled==1){
                            include('navFilledList.php');
                        }else{
                            include('navWorkoutList.php');
                        }
                        
                ?>
            </div>
        </div>
    </body>
</html>
