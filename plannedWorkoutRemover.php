<?php
header('Content-Type: text/xml');
echo '<?xml version="1.0" encoding="UTF-8" standalone="yes" ?>';
echo '<response>';
if(isset($_POST[id])){
    $workoutBasketLine = $_GET['id'];
    echo $workoutBasketLine;
}else{
    $message = 'no post data received';
    //Value sent for updating an exercise line in workoutbasket
    //Need to create new table(plannedWorkoutBasket which won't be updated here)
    echo $message;
}
echo '</response>';
?>