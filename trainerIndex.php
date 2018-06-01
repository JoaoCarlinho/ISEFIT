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
<<<<<<< HEAD
            }else{
=======
            }
>>>>>>> 297478587b120b121a1bd94d40953e29eea03024
            ?>
 
            <div class = "main">
                <?php 
<<<<<<< HEAD
                    include('trainerInfo.php');
                    include('trainerOptions.php');
            }
=======
                    include('navbar.php');
                    include('trainerInfo.php');
                    include('trainerOptions.php');
>>>>>>> 297478587b120b121a1bd94d40953e29eea03024
                ?>
            </div>
        </div>
    </body>
</html>

