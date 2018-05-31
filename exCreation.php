<?php  /****   exCreation.php *****************************************************************************************/

if(isset($_GET['message'])){
    $message = $_GET['message'];
    $color = 'red';
}else{
    $message = 'Please fill in all fields to submit an exercise';
    $color = 'black';
} 


/******Ensure name, focusID, pushOrPull, isolation and exerciseTypeID specified for new exercise****************/
if(isset($_POST['name']) && isset($_POST['focusID']) && isset($_POST['pushOrPull']) && isset($_POST['isolation']) && isset($_POST['exerciseTypeID'])){
        include('newEx.php');
}else{
     	include('exEntry.php');
     } 
?>