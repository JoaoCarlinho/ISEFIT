<?php
    include('exArray.php');
    header('Content-Type: text/xml');
    echo '<?xml version="1.0" encoding="UTF-8" standalone="yes" ?>';
    if(isset($_GET['exercise'])){
        echo '<response>';
            $exercise = $_GET['exercise'];
            if(in_array($exercise, $directory)){
                echo 'Lets do some '.$exercise.'!';
            }
            elseif($exercise == ''){
                echo 'Select a workout';
            }
            else{
                echo 'Sorry punk, we dont do no'.$exercise.'!';
            }
    }
    echo '</response>';
?>