<?php  /****   groupCreation.php *****************************************************************************************/
//If all these are set, enter them into the database and go to newGroup.php

if(isset($_GET['message'])){
    $message = $_GET['message'];
    $color = 'red';
}else{
    $message = 'New User Registration';
    $color = 'black';
} ?>

<!DOCTYPE HTML>
<html>
<!--*******************************************gc.php(registration index)***********************************************************-->
    <?php include 'header.php';?>

    <body>
            <?php include'appBar.php';?>
            <div style="height: 200px;">
                <div class="formBox"><center>
                 <a href="clientRegistration.php"><div class="loginButton">Athlete Registration</div></a><br/><br/><br/>
                 <a href="trainerRegistration.php"><div class="loginButton">Trainer Registration</div></a>
                </center></div>
            </div>
            <?php include 'footer.php'; ?>
    </body>
</html>