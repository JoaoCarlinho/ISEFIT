<?php 
/************************************************Template for sourcing a dropdown from a database*************************************************/
require_once('connect.php');
$foci = array();//array for storing database records
$creator = array();

$db = connect();
$query = $db->prepare("SELECT focusID, focusArea FROM focusAreas ") or die("could not check member");
$query->execute();
$row = $query->fetchAll(PDO::FETCH_ASSOC);
            $count = count($row);
            
             foreach($row as $info){
                $creator[0]=$info['focusID'];
	            $creator[1]=$info['focusArea'];
	            $foci[]=$creator;
             }   
?>
<html>
    <div class="focusSelectBox"><center>Focus Selector</center>
            <center>                       
                <select id="focusSelector" name="focusID" >
<<<<<<< HEAD
                    <option value="<?php echo $foci[0][0]; ?>" selected="selected"><?php echo $foci[0][1]; ?></option>
           <?php for ($x = 1; $x < count($foci) ; $x++){ 
                        echo('<option value="'.$foci[$x][0].'">'.$foci[$x][1].'</option>');
=======
                    <option value="1" selected="selected"><?php echo $foci[0][1]; ?></option>
           <?php for ($x = 2; $x < count($foci) ; $x++){ 
                        echo('<option value="'.$x.'">'.$foci[$x-1][1].'</option>');
>>>>>>> 297478587b120b121a1bd94d40953e29eea03024
                 }
           ?>
                </select><br> 
            </center>        
    </div>
</html> 