<?php
session_start();
session_unset();
session_destroy();
$logged = 0;

?>

<?php   include('session.php');    ?>
<!DOCTYPE html>
<html lang="en-us">
    <?php include('header.php'); ?>
    <body>
        <div class="container">
            <?php /********These are always on the page and used to find out what else to display*******************/
            include('appBar.php'); 
            include('banner.php');
            ?>
 
            <div class = "main">
                <center><div>
                    <p>You've been logged out</p>
                </div></center>
                <?php 
                    include('navbar.php');
                    include('clientInfo.php');
                ?>
            </div>
            <?php include('footer.php')?>
        </div>
    </body>
</html>