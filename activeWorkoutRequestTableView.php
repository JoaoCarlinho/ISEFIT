<div class="exTable">
    <center>workout Requests
    <table cellpadding="2" cellspacing="2" border="1">
        <tr>
            <th>Request ID</th><th>client ID</th><th>Fill Date </th><th>Mode</th>
        </tr>
        
        <tr>
            <?php
                for($i=0; $i<count($list); $i++){
            ?>
                <tr>
                    <td><?php echo $list[$i][0]; ?></td><!-- requestID -->
                    <td><?php echo $list[$i][1]; ?></td><!-- clientID -->
                    <td><?php echo $list[$i][2]; ?></td><!-- Fill Date -->
                    <td><?php echo $list[$i][3]; ?></td><!-- modeID -->
                    <td><a href="requestFiller.php?requestID=<?php echo $list[$i][0]; ?>">Create Workout</td><!-- redirect -->
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
