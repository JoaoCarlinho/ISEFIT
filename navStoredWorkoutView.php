<!DOCTYPE html>
<html lang="en-us">
    <?php include('getAdaptName.php'); ?>
    <?php include('header.php'); ?>
    <body>
        <div class="container">
            <?php /********These are always on the page and used to find out what else to display*******************/
            include('appBar.php'); 
            ?>
 
            <div class = "main">
                <center><p>storing workout number <?php echo $workoutID; ?></p>
            <p>Workout Number: <?php echo $workoutID; ?></p>
                        <table cellpadding="2" cellspacing="2" border="1" bordercolor="#66ccff" bgcolor="#66ccff">
                            <tr>
                                <th>Adaptation</th><th>Mode</th><th>Focus Area</th><th>workout Date</th>
                            </tr>
                                <tr>
                                    <a href="navExSelector.php?workoutID=<?php echo $workoutID; ?>">
                                        <td><?php echo $adaptation; ?></td><!-- adaptation -->
                                        <?php
                                        include('getModeName.php'); 
                                        ?>
                                        <td><?php echo $modeName; ?></td><!-- mode ID -->
                                        <td><?php echo $focus; ?></td><!-- focus -->
                                        <td><?php echo $workoutDate; ?></td><!-- datePlanned -->
                                    </a>
                                </tr>
                        </table>
                        <br/>
                        <p>Exercises:</p>
                        <table cellpadding="2" cellspacing="0" border="1" bordercolor="#ffffff" bgcolor="#66ccff" id="exChart">
                            <tr>
                                <th>exName</th><th >set</th><th >duration(sec or reps)</th><?php
                                        $resistance = 0;
                                        foreach($basket as $exercise){
                                            if($exercise[1] == 1){
                                                $resistance = 1;
                                            }
                                        }
                                        if($resistance ==1){
                                    ?>
                                        <th >weight(lbs)</th></tr>
                                    <?php
                                        }else{ ?>
                                            </tr>
                                <?php   }
                            
                            foreach($basket as $exLine){
                                            ?>
                                            <tr id="<?php echo $workoutID.'_'.$exLine[3].'_'.$exLine[2]; ?>">
                                                <?php if ($exLine[2] == 0){ 
                            /**************************Put exName and adaptation in first column for each exercise*************************/
                                                $adaptName = getAdaptName($exLine[8]);
                                                ?>
                                                <td  rowspan="<?php echo $exLine[7] ?>"><?php echo $exLine[0].' as '.$adaptName; ?></td><!-- exName -->
                                                                    <?php    } ?>
                            <!--**************************list setNumber for this exercise(not editable)*************************-------------------------------->
                                                <td class="setNumber" ><?php echo $exLine[2] + 1; ?></td><!-- setNumber ( equals setIndex + 1 -->
                                        <?php if($exLine[1] == 1 || $exLine[1] == 1){ ?>
                            <!--**************************list number of reps for this set(editable)*************************-------------------------------->
                            <!--*****Clicking on this makes it editable.  onChange will send update to plannWorkoutUpdater with, workoutID, exID, setIndex, currentValue and adjustmentType to update workoutBasket-->
                                                <td class="repDurWei"><?php echo $exLine[5]; ?></td><!-- reps -->
                                        <?php   }else{ ?>
                            <!--**************************list duration for this set(editable)*************************-------------------------------->
                            <!--*****Clicking on this makes it editable.  onChange will send update to plannWorkoutUpdater with workoutID exID, setIndex, currentValue and adjustmentType to update workoutBasket-->
                                                <td class="repDurWei" ><?php echo $exLine[4]; ?></td><!-- duration -->
                                        <?php   } ?>
                                        <?php    if($exLine[1] == 1){
                                                    ?>
                            <!--**************************list weight for this set(editable)*************************-------------------------------->
                            <!--*****Clicking on this makes it editable.  onChange will send update to plannWorkoutUpdater with workouID, exID, setIndex, currentValue and adjustmentType  to update workoutBasket-->
                                                        <td class="repDurWei" ><?php echo $exLine[6]; ?></td><!-- weight -->
                                                        </tr><!--******************delete removes this setNumber for this exID and workoutID from workoutBasket and updates setCount to be one less, then re-inputs everything else---------------->
                                                    <?php
                                                        }else{ ?>
                                                            </tr><!--******************delete removes this setNumber for this exID and workoutID from workoutBasket and updates setCount to be one less, then re-inputs everything else---------------->
                                                    <?php    }
                            }                        
                                                    ?>
                    
                        </table><br>
                 <a href="navIndex.php"><input style="background-color:green; font-weight:bold; border-radius:8px; height:20px; width:200px;" type="submit" value="back to workouts"/></a>
    </center>
            </div>
        </div>
    </body>
</html>