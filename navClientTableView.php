<div class="exTable">
    <table cellpadding="2" cellspacing="2" border="1">
        <tr>
            <th colspan="2">clients</th>
        </tr>
        <tr>
            <td>name</td><td>ID</td>
        </tr>
        
    <?php
        for($i=0; $i<count($list); $i++){
    ?>
        <tr>
            <td><a href="clientWorkouts.php?clientID=<?php echo $list[$i][1]; ?>"><?php echo $list[$i][0]; ?></a></td><!-- nickName -->
            <td><?php echo $list[$i][1]; ?></td><!-- clientID -->
        </tr>
    <?php   
        }
    ?>
        </tr>
    </table>
    
</div>