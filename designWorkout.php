<html lang="en-us">
    <?php 
        include('session.php');
        include('header.php');
    ?>
    <body>
        <div class="container">
            <?php   include('appBar.php'); 
                    include('banner.php');
            ?>
            <!--<center><div class="profile_center"> </div></center>-->
            <div class = "main">
                <?php
                    
                    include('buildWorkout.php');
                ?>                
            </div>    
            <?php include('footer.php')?>
        </div>
    </body>
</html>