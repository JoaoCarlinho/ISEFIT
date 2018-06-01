<?php
    header('Content-Type: text/xml');
    echo '<?xml version="1.0" encoding="UTF-8" standalone="yes" ?>';
<<<<<<< HEAD
    
    echo '<response>';
        $exercise = $_GET['exercise'];
        $exArray = array('squats', 'push-ups', 'lunges', 'toe-touches', 'bikes', 'rows');
        if(in_array($exercise, $exArray)){
            echo 'Lets do some '.$exercise.'! <br/> 
            <input type="button" value="Add '.$exercise.'s" onClick="doStuff()">';
        }
        elseif($exercise == ''){
            echo 'Select a workout';
        }
        else{
            echo 'Sorry punk, we dont do no'.$exercise.'!';
        }
=======
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
>>>>>>> 297478587b120b121a1bd94d40953e29eea03024
    echo '</response>';
?>