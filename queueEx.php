<?php
<<<<<<< HEAD
    include('exArray.php');
=======
>>>>>>> 297478587b120b121a1bd94d40953e29eea03024
    include('exInserter.php');
    
    if(isset($_POST['exercise'])){
            $exercise = $_POST['exercise'];
            //*********************************************good workout submitted
            if(in_array($exercise, $directory)){
                echo $message;
            }
            elseif($exercise == ''){
                echo 'Select a workout';
            }
            else{
                echo'choose an actual workout,<br> may need a trainer reference';
            }
    }
?>