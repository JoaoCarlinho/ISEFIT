<?php
require_once('connect.php');
$db = connect();

/*************************************************** Directory exercises *************************************************/
<<<<<<< HEAD
$query = $db->prepare("SELECT exName FROM exercises") or die("could not display exercises");
=======
        $query = $db->prepare("SELECT name FROM exercises") or die("could not display exercises");
>>>>>>> 297478587b120b121a1bd94d40953e29eea03024
        $query->execute();
        $row = $query->fetchAll(PDO::FETCH_ASSOC);
        $count = count($row);
        
        if($count > 0){
/*******************************************exercises found in directory*******************************************/
                $directory = array();
                //read each returned exercise's info
                 foreach($row as $info){     
    	        //put items into a basket for use today   
<<<<<<< HEAD
                    $directory[]=$info['exName'];
                 }
        }else{
            echo('Exercise table empty');
        }
        
        
=======
                    $directory[]=$info['name'];
                 }
        }
>>>>>>> 297478587b120b121a1bd94d40953e29eea03024
?>