<?php
    include('exArray.php');
    header('Content-Type: text/xml');
    echo '<?xml version="1.0" encoding="UTF-8" standalone="yes" ?>';
    if(isset($_GET['exercise'])){
        echo '<response>';
            $exercise = $_GET['exercise'];
            if(in_array($exercise, $directory)){
<<<<<<< HEAD
                echo 'Lets do some '.$exercise.'s!';
            }
            elseif($exercise == ''){
                echo 'Select an Exercise';
            }
            else{
                echo 'Sorry punk, we dont do no '.$exercise.'s!';
=======
                echo 'Lets do some '.$exercise.'!';
            }
            elseif($exercise == ''){
                echo 'Select a workout';
            }
            else{
                echo 'Sorry punk, we dont do no'.$exercise.'!';
>>>>>>> 297478587b120b121a1bd94d40953e29eea03024
            }
    }
    echo '</response>';
?>