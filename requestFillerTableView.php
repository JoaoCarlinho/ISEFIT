<?php
?>
<!DOCTYPE html>
<html>
    <?php include('header.php'); ?>
    
    <body >
         <div class="container">
            <?php /********These are always on the page and used to find out what else to display*******************/
            include('appBar.php'); 
            ?>
 
            <div class = "main">
                <center>
    <table cellpadding="2" cellspacing="2" border="1">
        <tr>
            <th>Request ID</th><th>client ID</th><th>Fill Date </th><th>Mode</th><th>adaptation ID</th><th>workout date</th>
        </tr>
        
        <tr>
                <tr>
                    <td><?php echo $requestID; ?></td><!-- requestID -->
                    <td><?php echo $clientID; ?></td><!-- clientID -->
                    <td><?php echo $requestSLADate; ?></td><!-- Fill Date -->
                    <td><?php echo $modeID; ?></td><!-- modeID -->
                    <td><?php echo $adatpationID; ?></td><!-- adaptationID -->
                    <td><?php echo $datePlanned; ?></td><!-- workout date -->

                </tr>
        </tr>
    </table>
                <div style=" border:solid 1px #000000;"><h3>the ISE maker</h3>
                    <form action="requestFiller.php" method="post">
                       <input type="hidden" name="workoutID" value="<?php echo $workoutID; ?>"/>
                       <p>Editing <?php echo $adaptation; ?> workout number <?php echo $workoutID; ?><br/>
                          
                          To be completed <?php echo $requestExecID; ?><br/>
                       </p>
            <!--******************************************autocomplete for Exercise Name*******************-------------------------------------------->
                        <p>Enter the exercise you'd like to add to workout #<?php echo $workoutID; ?>:</p>
                        <?php include('exSelector.php') ?>
                        <!--- send exID variable -->
            <!--******************************************input for rep count**********************************----------------------------------------->
                        <p>Enter the number of sets for this exercise:</p>
                        <?php include('getSetCount.php'); ?><br/><br/>
            <!--******************************************autoComplete for adaptation**********************************----------------------------------------->
                        <?php include('adaptSelector.php'); ?>
                        <!--- send adaptID variable -->
                        
                <!-- the bottom below with onClick="queueEx(); with ajax for single page functionality-->
                        <input type="submit" value="add Exercise!"/>
                    </form>
                        <p id="queueStatus"></p>
                </div></center>
                <?php include('navRequestBasket.php'); ?>
            </div>
        </div>
    </body>
</html>
