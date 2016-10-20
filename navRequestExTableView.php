<div class="exTable">
    <center><h1>Workout Summary!</h1></center>
    <table cellpadding="2" cellspacing="2" border="1">
        <tr>
            <th>option</th><th>exName</th><th>sets</th><th>adaptationID</th>
        </tr>
        
        <tr>
            <?php
                    $listed = array();
                for($i=0; $i<count($basket); $i++){
                    if( ! in_array( $basket[$i][2], $listed ) )
                    {
                        $listed[] = $basket[$i][2];
            ?>
                    <tr>
                        <!--This button will use ajax for single page application-->
                        <!-- deleted button--><td ><a href="navExSelector.php?index=<?php echo $i; ?>&workoutID=<?php echo $workoutID; ?>&exName=<?php echo $basket[$i][0]; ?>">Delete</td> 
                        <!-- exName --><td><?php echo $basket[$i][0]; ?></td>
                        <!-- setCount --><td><?php echo $basket[$i][1]; ?></td>
                        <!-- adaptationID --><td><?php echo $basket[$i][3]; ?></td>
    
                    </tr>
             <?php 
                    }
                }
            ?>
        </tr>
    </table><br/>
    <a href="navRequestPlanner.php?workoutID=<?php echo $workoutID; ?> "><input class="createWorkoutButton" type="submit" value="Plan Workout!"/></a><br/><br/>
    <a href="trainerIndex.php"><input class="createWorkoutButton" type="submit" value="back to requests"/></a>
    
</div>