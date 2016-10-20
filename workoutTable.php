<?php  /** associate index of each exercise in basket with exTypeID and create inputs for rep/time and weights for each **/   ?>

<table cellpadding="2" cellspacing="2" border="1">
        <tr>
            <th>option</th><th>exNumber</th><th>exName</th><th>exType</th>
        </tr>
        
        <tr>
            <?php for($ci=0; $ci<count($basket); $ci++){ ?>
                <tr>
                    <td>Delete(use ajax to remove this line from the workout)</td>
                    <td><?php echo ($ci + 1); ?></td><!-- row number -->
                    <td><?php echo $basket[$ci][0]; ?></td><!-- exName -->
                    <td><?php /** display exercise type based on exTypeID **/
                        if( $basket[$ci][1] == 1){
                           echo 'resistance'; 
                        }else if( $basket[$ci][1] == 2){
                           echo 'cardio'; 
                        }else if( $basket[$ci][1] == 3){
                           echo 'mma'; 
                        }else if( $basket[$ci][1] == 4){
                           echo 'cardio'; 
                        }
                        ?>
                    </td><!-- exTypeID -->
                    <td><?php echo $basket[$ci][2]; ?></td><!--setCount-->
                    <td>add input for number of sets and weight for each set base on resistance type</td><!--this input should open up as many input for reps/set and weights to be entered for resistance exercises, and if exercises is counted or timed, put space for count or time in seconds-->
                </tr>
            <?php } ?>
        </tr>
</table>
<input type="submit" value="Create Workout!" onclick="listWorkout()"/>