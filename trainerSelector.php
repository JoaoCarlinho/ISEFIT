<?php 
/************************************************Template for sourcing a dropdown from a database*************************************************/
    require_once('connect.php');
    $trainerSelector = array();//array for storing database records

    $db = connect();
    $query = $db->prepare("SELECT trainerID, nickName FROM trainers ") or die("could not check member");
    $query->execute();
    $row = $query->fetchAll(PDO::FETCH_ASSOC);
            $count = count($row);
            if($count > 0){
                 foreach($row as $info){
                    $creator[0]=$info['trainerID'];
    	            $creator[1]=$info['nickName'];
    	            $trainerSelector[]=$creator;
                 }
            }
?>
<html>
    <div class="focusSelectBox"><center>Trainer Selector</center>
            <center>                       
                <select id="trainerSelector" name="trainerID" >
                   <?php for ($x = 1; $x <= count($trainerSelector) ; $x++){ 
                                echo('<option value="'.$x.'">'.$trainerSelector[$x-1][1].'</option>');
                         }
                   ?>
                </select><br> 
            </center>        
    </div>
</html> 