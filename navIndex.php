<?php   include('session.php');
        $home == 1;
?>
<!DOCTYPE html>
<html lang="en-us">
    <?php include('header.php'); ?>
    <body>
        <div class="container">
            <?php /********These are always on the page and used to find out what else to display*******************/
            include('appBar.php'); 
            $logged = $_SESSION['logged'];
            if($logged!=1){
                include('banner.php');
            }
            ?>
 
            <div class = "main">
                <?php 
                    include('clientInfo.php');
                ?>
            </div>
        </div>
    </body>
</html>