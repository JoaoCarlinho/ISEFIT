<!DOCTYPE html>
<html lang="en-us">
    <?php include('header.php'); ?>
    <body>
        <div class="container">
            <?php /********These are always on the page and used to find out what else to display*******************/
            include('appBar.php'); 
            ?>
 
            <div class = "main">
                <center><p>storing workout number <?php echo $workoutID; ?></p>
                <table cellpadding="2" cellspacing="2" border="1">
                <tr><th>Exercise</th><th>Set</th><th>Count</th>  
                
                <?php
                    $resistance = 0;
                    foreach($workoutPlan as $exercise){
                        if($exercise[1] == 1){
                            $resistance = 1;
                        }
                    }
                    if($resistance ==1){
                ?>
                    <th>weight</th></tr>
                <?php
                    }
                ?>
                
                <?php foreach($workoutPlan as $exLine){ ?>
                    <tr>
                        <td><?php echo $exLine[0]; ?></td>
                        <td><?php echo $exLine[2]; ?></td>
                        <td><?php echo $exLine[3]; ?></td>
            <?php      if($exLine[1] == 1){ ?>   
                        <td><?php echo $exLine[4]; ?></td>
            <?php       } ?>
                    </tr>
            <?php   }
            ?>
    </table><br>
                 <a href="navIndex.php"><input style="background-color:green; font-weight:bold; border-radius:8px; height:20px; width:200px;" type="submit" value="back to workouts"/></a>
    </center>
            </div>
        </div>
    </body>
</html>