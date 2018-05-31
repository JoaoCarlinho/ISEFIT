<?php 
/************************************************Template for sourcing a dropdown from a database*************************************************/
require_once('connect.php');
$adaptations = array();//array for storing database records

$db = connect();
$query = $db->prepare("SELECT adaptationID, adaptName FROM adaptations ") or die("could not check member");
$query->execute();
$row = $query->fetchAll(PDO::FETCH_ASSOC);
            $count = count($row);
            
             foreach($row as $info){
                $creator[0]=$info['adaptationID'];
	            $creator[1]=$info['adaptName'];
	            $adaptations[]=$creator;
             }   
?>
<html>
    <div class="adaptSelectBox"><center>Adaptation Selector</center>
            <center>                       
                <select id="adaptSelector" name="adaptID" >
                    <option value="1" select="selected"><?php echo $adaptations[0][1]; ?></option>
           <?php for ($x = 2; $x < count($adaptations) ; $x++){ 
                        echo('<option value="'.$x.'">'.$adaptations[$x-1][1].'</option>');
                 }
           ?>
                </select><br> 
            </center>        
    </div>
</html> 