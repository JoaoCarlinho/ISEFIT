<?php
include('session.php');
if(isset($_POST['requestExecDate']) && isset($_POST['requestSLADate']) && isset($_POST['generation']) && isset($_POST['trainerID']) && isset($_POST['adaptID']) && isset($_POST['focusID']) /** && isset($_POST['exArray']) **/){
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
            ?><center>
            <div class = "main">
                <p>Please Confirm submission</p>
                <table border="1">
                  <tr>
                      <th colspan="2">Workout Request</th>    
                  </tr>
                  <tr>
                      <td>Workout Date</td><td><?php echo $requestExecDate; ?></td>
                  </tr>
                  <tr>
                      <td>Request Due Date</td><td><?php echo $requestSLADate; ?></td>
                  </tr>
                  <tr>
                      <td>Request Type</td><td><?php echo $generation; ?></td>
                  </tr>
                  <tr>
                      <td>Trainer</td><td><?php echo $trainerName; ?></td>
                  </tr>
                  <tr>
                      <td>Adaptation</td><td><?php echo $adaptName; ?></td>
                  </tr>
                  <tr>
                      <td>Area of focus</td><td><?php echo $focusArea; ?></td>
                  </tr>
                  <!-- Foreach exercise in ex array make exercise number of index + 1 and put exName on the right side 
                  <tr>
                      <td>Exercise <php echo $i + 1; ?> </td><td><php echo $exName; ?></td>
                  </tr>
                  -->
                
                </table>
            
                <form action="workoutRequested.php" method="post">
                    <input type="hidden" name="requestExecDate" value="<?php echo $requestExecDate; ?>"/>
                    <input type="hidden" name="requestSLADate" value="<?php echo $requestSLADate; ?>"/>
                    <input type="hidden" name="generation" value="<?php echo $generation; ?>"/>
                    <input type="hidden" name="trainerID" value="<?php echo $trainerID; ?>"/>
                    <input type="hidden" name="adaptID" value="<?php echo $adaptID; ?>"/>
                    <input type="hidden" name="focusID" value="<?php echo $focusID; ?>"/>
                  <!-- Foreach exercise in ex array make exercise number of index + 1 and put exName on the right side 
                      <input type="hidden" name="ex<php echo $i + 1; ?>" value="<php echo $exName; ?>"/>
                  -->
                    <br/>
                    <input class="createWorkoutButton" type="submit" value="confirm" />
                    
                </form>
            </div>
            <br/>
        
            <a href="navIndex.php"  ><button type="button" style="background-color:red; font-weight:bold;">Cancel</button></a>
        
            </center>     

        </div>    
</html>