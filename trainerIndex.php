<?php   include('session.php');    ?>
<!DOCTYPE html>
<html lang="en-us">
    <?php include('header.php'); ?>
    <body>
        <div class="container">
            <?php /********These are always on the page and used to find out what else to display*******************/
            include('appBar.php'); 
            if(empty($_SESSION['trainer'])){
                include('banner.php');
            }
            ?>
 
            <div class = "main">
                <?php 
                    include('navbar.php');
                    include('trainerInfo.php');
                    include('trainerOptions.php');
                ?>
            </div>
        </div>
    </body>
</html>

