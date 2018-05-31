<?php /*************************************************** Create directory of exercises for use as autoComplete *************************************************/
        require_once('connect.php');
        $query = $db->prepare("SELECT exName FROM exercises ORDER BY exName ASC") or die("could not display exercises");
        $query->execute();
        $row = $query->fetchAll(PDO::FETCH_ASSOC);
        $count = count($row);
        
        if($count > 0){
/*******************************************exercises found in directory*******************************************/
                $exDirectory = array();
                //read each returned exercise's info
                 foreach($row as $info){     
    	        //put items into a basket for use today
                    $exDirectory[]=$info['exName'];
                 }
        }
        
?>

<html>
    <div class="exDirectory"><center>Exercise Selector</center>
            <center>                       
                <select id="exSelector" name="exID" >
                    <option value="1" selected="selected"><?php echo $exDirectory[0]; ?></option>
           <?php for ($x = 1; $x < count($exDirectory) ; $x++){
                        $y = $x + 1;
                        echo('<option value="'.$y.'">'.$exDirectory[$x].'</option>');
                 }
           ?>
                </select><br> 
            </center>        
    </div>
</html> 