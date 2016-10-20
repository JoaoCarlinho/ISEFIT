<div class="exTable">
    <center>Open workout Requests
    <table cellpadding="2" cellspacing="2" border="1">
        <tr>
            <th>Request ID</th><th>trainer ID</th><th>Service Date </th><th>Mode</th>
        </tr>
        
        <tr>
            <?php
                for($i=0; $i<count($list); $i++){
            ?>
                <tr>
                    <td><?php echo $list[$i][0]; ?></td><!-- requestID -->
                    <td><?php echo $list[$i][1]; ?></td><!-- trainerID -->
                    <td><?php echo $list[$i][2]; ?></td><!-- Service Date -->
                    <?php $modeID = $list[$i][3];
                          include('getModeName.php');
                    ?>
                    <td><?php echo $modeName; ?></td><!-- modeID -->
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
