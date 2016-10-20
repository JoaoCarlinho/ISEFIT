<?php

require_once('connect.php');
            $list = array();
            $creator = array();
            $query = $db->prepare("SELECT nickName, certifications, gender, zip FROM trainers") or die("could not query workoutBasket");
            $query->execute();
            $row = $query->fetchAll(PDO::FETCH_ASSOC);
            //read each returned item's info
             foreach($row as $info){
	        //put exercises into a basket for use today 
	            $creator[0]=$info['nickName'];
	            $creator[1]=$info['certifications'];
	            $creator[2]=$info['gender'];
	            $creator[3]=$info['zip'];

	            $list[]=$creator;
             }
?>
<div class="exTable" style="maring:20px auto 20px auto">
    <center>
        <p>Fitness Coaching from the best professionals around</p>
    <table cellpadding="2" cellspacing="2" border="1">
        <tr>
            <th>nickName</th><th>certifications</th><th>gender</th><th>zip</th>
        </tr>
        
        <tr>
            <?php
                for($i=0; $i<count($list); $i++){
            ?>
                <tr>
                    <td><?php echo $list[$i][0]; ?></td><!-- nickName -->
                    <td><?php echo $list[$i][1]; ?></td><!-- certificaitons-->
                    <td><?php echo $list[$i][2]; ?></td><!-- gender -->
                    <td><?php echo $list[$i][3]; ?></td><!-- zip -->

                </tr>
            <?php   
                }
            ?>
        </tr>
    </table></center>
    
</div>