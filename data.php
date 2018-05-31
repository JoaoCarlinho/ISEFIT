<?php 
  /**  if(isset($_POST['name']) === true && empty($_POST['name']) === false){**/
        $ex = $_POST['name'];
        require('connect.php');
        $db = connect();
    
        $query = $db->prepare("SELECT name FROM exercises") or die("could not display exercises");
        $query->execute();
        $row = $query->fetchAll(PDO::FETCH_ASSOC);
        $count = count($row);
        
        if($count > 0){
/*******************************************exercises found in directory*******************************************/
                $directory = array();
                //read each returned exercise's info
                 foreach($row as $info){     
    	         echo $info['name'].'<br>';
                 }
        }else{
            echo('Exercise not stored');
        }
/**    }  **/
?>