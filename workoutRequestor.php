<?php

include('session.php'); 
require_once('connect.php');

            $trainerID = 0;
            $db = connect();
/***********************find out if current client has an assigned trainer*********************/
            $query = $db->prepare("SELECT currentTrainerID FROM clients WHERE email = '$username'") or die("could not check member");
            $query->execute();
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            $count = count($result);
if($count == 1){
            foreach($result as $info){
                $trainerID = $info['currentTrainerID'];
               /** select trainers nickname from db **/
            }
}
?>

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
                    <form action="requestConfirmation.php" method="post">
                      <!--  /********************workout completion date?*******/  -->
                        <p>When will you complete this workout?</p>
                        <input type="date" name="requestExecDate"/>
                     <!--   /********************request espected return date?*******/-->
                         <p>When do you need this request filled by?(if more than two days before) completion date)</p>
                        <input type="date" name="requestSLADate" />
                
                <!--/********************Ask if this request is for a trainer or auto-generation **********/ -->
                        <p>Prefer auto-generated or trainer-generated workout?</p>
                        Automated <input type="radio" name="generation" value="auto" checked="checked"/><br>
                        Trainer <input type="radio" name="generation" value="trainer"><br> 
                
                <!--  Ajax call checkGeneration()  If trainer selection, include drop down if no trainer assigned, or a paragraph with trainer’s nickname for an assigned trainer    -->
                        <div>
                            <?php include('trainerSelector.php'); ?>
                        </div>
                
                <!--/********************which adaptation?**********/ -->
                        <?php include('adaptSelector.php') ?>
                
                <!--/********************focusArea? **********/ -->
                        <?php include('focusSelector.php') ?>
                <!--/********************specific muscle groups? *** include auto complete and update a table*******/ -->
                        
                <!--/********************specific exes? *** include auto complete and update a table*******/ -->
                        <?php /** include('exSelector.php') **/ ?>
                        <!--  ajax call button to update table below with exercises and create hidden post value called exArray -->
                       <!-- <p onClick="requestEx()">add exercise</p> -->
                        
                
                        <input class="createWorkoutButton" type="submit" value="Submit"/>
                    </form>
                </center>     
            </div>
        </div>    
</html>