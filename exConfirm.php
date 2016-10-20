<table cellpadding="2" cellspacing="2" border="1">
    <tr>
        <th>option</th><th>Id</th><th>Name</th><th>Price</th><th>Quantity</th><th>Sub Total</th>
    </tr>
    
    <tr>
        <?php
            $s = 0;
            
            for($ci=0; $ci<count($basket); $ci++){
                $s += $basket[$ci][2] * $basket[$ci][3];
        ?>
            <tr>
                <td>Delete(use ajax to remove this line)</td>
                <td><?php echo $basket[$ci][0]; ?></td><!-- clientID -->
                <td><?php echo $basket[$ci][1]; ?></td><!-- exName --> 

            </tr>
        <?php   
            }
        ?>
    </tr>
    <tr>
        <td colspan="4" align="right">Sum</td>
        <td align="left"><?php echo $s; ?></td>
    </tr>
</table>
<br>
<a href ="shoppingcart.php?cartStatus=0&customerID=<?php echo $_SESSION['customerID']?>">create workout!</a>