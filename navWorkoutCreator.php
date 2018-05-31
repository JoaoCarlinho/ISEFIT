<?php   

include('session.php');    
/**  set adaptation and focusArea for a workout on this page and send to eXSelector*************/

if(isset($_GET['newWorkout']) && isset($_SESSION['clientID'])){
        $clientID = $_SESSION['clientID'];
        
}elseif(isset($_GET['workoutID'])){
    /**************reassign values for workout already planned*********/
}
else{
    header('Location: navIndex.php');
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
                        include('navWorkoutStarter.php');
                        include('plannedWorkouts.php');

                ?>
            </div>
        </div>
    </body>
</html>
