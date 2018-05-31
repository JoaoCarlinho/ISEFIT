<?php
require_once('connect.php');
$db = connect();

/*************************************************** Directory exercises *************************************************/
$query = $db->prepare("SELECT exName FROM exercises") or die("could not display exercises");
        $query->execute();
        $row = $query->fetchAll(PDO::FETCH_ASSOC);
        $count = count($row);
        
        if($count > 0){
/*******************************************exercises found in directory*******************************************/
                $directory = array();
                //read each returned exercise's info
                 foreach($row as $info){     
    	        //put items into a basket for use today   
                    $directory[]=$info['exName'];
                 }
        }else{
            echo('Exercise table empty');
        }
        
        
?>