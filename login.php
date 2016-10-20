<?php   include('session.php');    ?>
<!DOCTYPE html>
<html lang="en-us">
    <?php include('header.php'); ?>
    <body>
        <div class="container">
            <?php /********These are always on the page and used to find out what else to display*******************/
            include('appBar.php'); 
            ?>
 
            <div class = "main">
                <center>
                    <a href="clientLogin.php"><div class="loginButton" >Athlete Portal</div></a><br/><br/><br/>
                    <a href="trainerLogin.php"><div class="loginButton" >Coach Portal</div></a><br/><br/>
                 </center>
                <?php
                    include('banner.php');
                    include('navbar.php');
                    include('clientInfo.php');
                ?>
            </div>
            <?php include('footer.php')?>
        </div>
    </body>
</html>
