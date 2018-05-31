<html>
    <div class="exTable">
        <center>Past workouts
            <table cellpadding="2" cellspacing="2" border="1">
                <tr>
                    <th>id</th><th>created on</th><th>adaptation</th><th>focus</th><th>Workout Date</th>
                </tr>
                
                <tr>
                    <?php
                        for($i=0; $i<count($list); $i++){
                            $workoutDetailLink = 'workoutDetail.php?view='.$view.'&workoutID='.$list[$i]['workoutID'];
                    ?>
                        <tr>
                                <td><a href=<?php echo $workoutDetailLink; ?>><?php echo $list[$i]['workoutID']; ?></a></td><!-- workoutID -->
                                <td><a href=<?php echo $workoutDetailLink; ?>><?php echo $list[$i]['createDate']; ?></a></td><!-- createDate -->
                                <td><a href=<?php echo $workoutDetailLink; ?>><?php echo $list[$i]['adaptation']; ?></a></td><!-- adaptationID -->
                                <td><a href=<?php echo $workoutDetailLink; ?>><?php echo $list[$i]['focus']; ?></a></td><!-- focusID -->
                                <td><a href=<?php echo $workoutDetailLink; ?>><?php echo $list[$i]['completeDate']; ?></a></td><!-- completeDate -->
                        </tr>
                    <?php   
                        }
                    ?>
                </tr>
            </table>
            <a href="navIndex.php">cancel</a><br/>
            <p>redirect to navIndex.php</p>
        </center>
    </div>
</html>