<?php
include('session.php');
if(isset($_SESSION['clientID']) && isset($_POST['requestExecDate']) && isset($_POST['requestSLADate']) && isset($_POST['generation']) && isset($_POST['trainerID']) && isset($_POST['adaptID']) && isset($_POST['focusID']) /** $$ isset($_POST['modeID']) && isset($_POST['exArray']) **/){
    require_once('connect.php');
    $db = connect();
    
    $clientID = $_SESSION['clientID'];
    $requestDate = date("Y-m-d H:i:s");
    $requestExecDate = $_POST['requestExecDate'];
    $requestSLADate = $_POST['requestSLADate'];
    $generation = $_POST['generation'];
   /************************ Assign name to trainer selected for workout if not one already under contract *************************/ 
        $trainerID = $_POST['trainerID'];
        include('getTrainerName.php');
        
        $adaptID = $_POST['adaptID'];
        include('getAdaptName.php');
        
        $focusID = $_POST['focusID'];
        include('getFocusArea.php');
        
    //add new group to directory and send email confirmation
    $query = $db->prepare("INSERT INTO workoutRequests (clientID, trainerID, requestSLADate, requestType, requestDate, requestExecDate, focusID, adaptationID) VALUES( ?, ?, ?, ?, ?, ?, ?, ?)") or die("could not search");
    $query->execute(array($clientID, $trainerID, $requestSLADate, $generation, $requestDate, $requestExecDate, $focusID, $adaptID));

    $db = null;    

}else{
    header('Location: workoutRequestor.php');
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
            <center>
            <div class = "main">
                <p>Please Confirm submission</p>
                <p>Your request to <?php echo $trainerName; ?> has been sent</p>    
                <p>Expect this request to be filled by <?php echo $requestSLADate; ?>,</p>
            </div>
        
            <a href="navIndex.php" ><input type="submit" class="createWorkoutButton" value="Home"></a>
            <?php include('openWorkoutRequests.php'); ?>
        
            </center>     
        </div>    
</html>


<?php
/*** include an email to the trainer below *******************************************************/
?>