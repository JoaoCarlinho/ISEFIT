<div class="exTable">
    <center>Planned Workouts
    <table cellpadding="2" cellspacing="2" border="1">
        <tr>
            <th>Mode</th><th>adaptation</th><th>Date</th>
        </tr>
        
        <tr>
            <?php
                for($i=0; $i<count($list); $i++){
                    $modeID = $list[$i][0];
                include('getModeName.php');
            ?>
                <tr>
                    <td><?php echo $modeName; ?></td><!-- modeID -->
                    <td><?php echo $list[$i][1]; ?></td><!-- adaptation -->
                    <td><?php echo $list[$i][3]; ?></td><!-- datePlanned -->
                    <td><a href="plannedWorkoutDetail.php?workoutID=<?php echo $list[$i][4]; ?>">Detail</a></td>
                    <td><a href="navExSelector.php?workoutID=<?php echo $list[$i][0]; ?>"><center>Edit</center></a></td>
                </tr>
            <?php   
                }
            ?>
        </tr>
    </table>
    <br/>
    <br/>
    </center>
</div>
