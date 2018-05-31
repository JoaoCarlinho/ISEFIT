<div class="exTable">
    <center>Upcoming workouts</center>
    <table cellpadding="2" cellspacing="2" border="1">
        <tr>
            <th>id</th><th>created on</th><th>adaptation</th><th>focusID</th><th>Workout Date</th>
        </tr>
        
        <tr>
            <?php
                for($i=0; $i<count($list); $i++){
            ?>
                <tr>
                    <td><?php echo $list[$i][0]; ?></td><!-- workoutID -->
                    <td><?php echo $list[$i][1]; ?></td><!-- createDate -->
                    <td><?php echo $list[$i][2]; ?></td><!-- adaptationID -->
                    <td><?php echo $list[$i][3]; ?></td><!-- focusID -->
                    <td><?php echo $list[$i][4]; ?></td><!-- datePlanned -->
                </tr>
            <?php   
                }
            ?>
        </tr>
    </table>
    <a href="navIndex.php"><input type="submit" value="cancel"/></a><br/>
    <p>redirect to navIndex.php</p>
    
</div>