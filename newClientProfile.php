<?php   include('session.php');    ?>
<!DOCTYPE html>
<html lang="en-us">
    <?php include('header.php'); ?>
    <body>
        <div class="container">
            <?php   include('appBar.php'); 
                    include('banner.php');
            ?>
            <!--<center><div class="profile_center"> </div></center>-->
            <div class = "main">
                <?php include('navbar.php');
                    if(!isset($logged)){ 
                                    include('trainingCarousel.php'); 
                    }                    
                    
                    if(isset($_SESSION['clientID'])){ 
                            include('exSelector.php');
                            //<!--<center><div id="queueStatus">queue Status</div></center>-->
        
                            include('exBasket.php');
                            //<!--<center><div id="workoutStatus">workout Status</div></center>-->
                    }else if(isset($_POST['username'])){?>
                            <center><a href="newClientProfile.php"><input type="button" name="lname" value="next workout"></a></center>
                <?php   }else{  include('trainingInfo.php');    } ?>                
            </div>    
            <?php include('footer.php')?>
        </div>
    </body>
</html>