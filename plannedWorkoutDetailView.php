    <!DOCTYPE html>
<html lang="en-us">
    <?php include('header.php'); ?>
    <body>
        <div class="container">
            <?php /********These are always on the page and used to find out what else to display*******************/
            include('appBar.php'); 
            //include('banner.php');
            ?>
 
            <div class = "main">
                <center>
              <?php if($filled ==1){ ?>
                        <p>Workout Number: <?php echo $workoutID; ?></p>
                        <table cellpadding="2" cellspacing="2" border="1" bordercolor="#66ccff" bgcolor="#66ccff">
                            <tr>
                                <th>Adaptation</th><th>Mode</th><th>Focus Area</th><th>workout Date</th>
                            </tr>
                                
                            <a href="navExSelector.php?workoutID=<?php echo $workoutID; ?>">
                                <tr>
                                    <td><?php echo $adaptation; ?></td><!-- adaptation -->
                                    <?php
                                    include('getModeName.php'); 
                                    ?>
                                    <td><?php echo $modeName; ?></td><!-- mode ID -->
                                    <td><?php echo $focus; ?></td><!-- focus -->
                                    <td><?php echo $workoutDate; ?></td><!-- datePlanned -->
                                </tr>
                            </a>
                        </table>
                        <br/>
                        <p>Exercises:</p>
                        <table cellpadding="2" cellspacing="0" border="1" bordercolor="#ffffff" bgcolor="#66ccff">
                            <tr>
                                <th>exName</th><th >set</th><th >duration</th><?php
                                        $resistance = 0;
                                        foreach($basket as $exercise){
                                            if($exercise[1] == 1){
                                                $resistance = 1;
                                            }
                                        }
                                        if($resistance ==1){
                                    ?>
                                        <th >weight</th></tr>
                                    <?php
                                        }else{ ?>
                                            </tr>
                                <?php   }
                            
                            foreach($basket as $exLine){
                                            ?>
                                            <tr>
                                                <?php if ($exLine[2] == 1){ ?>
                                                <td  rowspan="<?php echo $exLine[7] ?>"><?php echo $exLine[0]; ?></td><!-- exName -->
                                                                    <?php    } ?>
                                                
                                                <td class="setNumber" ><?php echo $exLine[2]; ?></td><!-- setNumber -->
                                        <?php if($exLine[1] == 1 || $exLine[1] == 1){ ?>
                                                <td class="repDurWei"><?php echo $exLine[5].' reps'; ?></td><!-- reps -->
                                        <?php   }else{ ?>
                                                <td class="repDurWei"><?php echo $exLine[4].' seconds'; ?></td><!-- duration -->
                                        <?php   } ?>
                                        <?php    if($exLine[1] == 1){
                                                    ?>
                                                        <td class="repDurWei"><?php echo $exLine[6].' lbs'; ?></td></tr><!-- weight -->
                                                    <?php
                                                        }else{ ?>
                                                            </tr>
                                                    <?php    }
                            }                        
                                                    ?>
                    
                        </table>
                        <br/>
                        <br/>
                        <center><div style="clear:both; width:400px;">
                            <a href="navExSelector.php?workoutID=<?php echo $workoutID; ?>"><div class ="createWorkoutButton" style="float:left;">Edit workout</div></a>
                            <a href="navWorkoutPlanner.php?workoutID=<?php echo $workoutID; ?>"><div class ="createWorkoutButton" style="float:left;">Save workout</div></a>
                        </div></center>
             <?php }else{ ?>
                         <p>No exercises planned for this workout</p>
                        <a href="navExSelector.php?workoutID=<?php echo $workoutID; ?>"><div class ="createWorkoutButton">Edit workout</div></a>
            <?php  }
             ?>
                    
                </center>
                
                
            </div>
            <?php   include('navbar.php');
            ?>
        </div>
    </body>
</html>