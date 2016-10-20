<div class="exTable">
    <table cellpadding="2" cellspacing="2" border="1">
        <tr>
            <th>option</th><th>exName</th><th>sets</th>
        </tr>
        
        <tr>
            <?php
                for($i=0; $i<count($basket); $i++){
            ?>
                <tr>
                    <td>Delete(use ajax to remove this line)</td> 
                    <td><?php echo $basket[$i][0]; ?></td><!-- exName -->
                    <td><?php echo $basket[$i][1]; ?></td><!-- setCount --> 
                </tr>
            <?php   
                }
            ?>
        </tr>
    </table>
    <a href="designWorkout.php?build=1"><input type="submit" value="Build Workout!"/></a>
    <p>send basket to buildWorkout.php</p>
</div>