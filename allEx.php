<?php
require_once('connect.php');
$db = connect();
 
/********************************************* Section for Tests before Inserting a new Exercise into the Directory***************************************************      **/
        if(isset($_GET['name']) && isset($_GET['focusID']) && isset($_GET['pushOrPull']) && isset($_GET['isolation'])){
            $name = $_GET['name'];
            $focusID = $_GET['focusID'];
            $pushOrPull = $_GET['pushOrPull'];
            $isolation = $_GET['isolation'];
    
/***************************************determine if there is an exercise stored with same name and focusID *******************************************/
        $query = $db->prepare("SELECT name,focusID
                               FROM exercises 
                               WHERE name = '$name' AND focusID = '$focusID'") or die("could not search exercises");
        $query->execute();
        $row = $query->fetchAll(PDO::FETCH_ASSOC);
        $count = count($row);
        
        if($count > 0){
                //exercise exists, Return to exCreation w/ message "exercise info entered matches current exercise:  Entry must be forced into database"
            $message = 'this exercise already exists';
            header("Location: exCreation.php?message=$message");
        }else{?>
 <!---------------------------------------------------Add new exercise to the directory ----------------------------------------------------------------------->
        <html>
              <center><div><?php echo('New exercise commited'); ?></div></center>
        </html>
             <?$query = $db->prepare("INSERT INTO exercises (name, focusID, pushOrPull, isolation) VALUES(?, ?, ?, ?)") or die("could not search");
             $query->execute(array($name, $focusID, $pushOrPull, $isolation));
        }
}

include('paginationTable.php');
include('homeButton.php');
?>