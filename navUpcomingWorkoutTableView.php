<div class="exTable" style="maring:20px auto 20px auto">
    <center>Upcoming workouts</center>
    <table cellpadding="2" cellspacing="2" border="1">
        <tr>
            <th>id</th><th>completion Date</th><th>adaptation</th><th>focusID</th><th>Open Workout</th><th>creation date</th>
        </tr>
        
        <tr>
            <?php
                for($i=0; $i<count($list); $i++){
            ?>
                <tr>
                    <td><?php echo $list[$i][0]; ?></td><!-- workoutID -->
                    <td><?php echo $list[$i][4]; ?></td><!-- workoutDate (datePlanned) -->
                    <td><?php echo $list[$i][2]; ?></td><!-- adaptationID -->
                    <td><?php echo $list[$i][3]; ?></td><!-- focusID -->
                    <td><?php echo $list[$i][1]; ?></td><!-- createDate -->
                    <td><a href="navExSelector.php?workoutID=<?php echo $list[$i][0]; ?>"><center>Edit</center></a></td>

                </tr>
            <?php   
                }
            ?>
        </tr>
    </table>
    
</div>