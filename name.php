<?php 
    if(isset($_POST['name']) === true && empty($_POST['name']) === false){
        require('connect.php');
        $db = connect();
    
        $query = $db->prepare("SELECT name FROM exercises WHERE name = :name") or die("could not display exercises");
        $query->execute(array(':name' => $_POST['name']));
        $row = $query->fetchAll(PDO::FETCH_ASSOC);
        $count = count($row);
        
        if($count > 0){
/*******************************************exercises found in directory*******************************************/
                $directory = array();
                //read each returned exercise's info
                 foreach($row as $info){     
    	         echo $info['name'];
                 }
        }else{
            echo('Exercise table empty');
        }
    }
?>