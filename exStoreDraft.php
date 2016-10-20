<?php
    header('Content-Type: text/xml');
    echo '<?xml version="1.0" encoding="UTF-8" standalone="yes" ?>';
    if(isset($_GET['timerUpdate'])){
        echo '<response>';
            $exercise = $_GET['exercise'];
            $exArray = array('squats', 'push-ups', 'lunges', 'toe-touches', 'bikes', 'rows');
            if(in_array($exercise, $exArray)){
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