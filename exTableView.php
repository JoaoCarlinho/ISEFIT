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
                    <td onClick="deleteRow(<?php echo $i; ?>,<?php echo $basket[$i][2]; ?>)" >Delete</td> 
                    <td><?php echo $basket[$i][0]; ?></td><!-- exName -->
                    <td><?php echo $basket[$i][1]; ?></td><!-- setCount -->
                </tr>
            <?php   
                }
            ?>
        </tr>
    </table>
    <a href="index.php"><input type="submit" value="refresh list"/></a><br/>
    <a href="designWorkout.php?build=1"><input type="submit" value="Build Workout!"/></a>
<<<<<<< HEAD
    <p>send basket to buildWorkout.php</p>
=======
    <p>send basket to buildWorkout.php</p>f
    
>>>>>>> 297478587b120b121a1bd94d40953e29eea03024
</div>