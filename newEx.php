<?php

//Ensure name, focusID, pushOrPull, and isolation specified for new exercise
//If all these are set, enter them into the database and go to allEmployees.php
if(isset($_POST['name'])){
    $name = $_POST['name'];
}else{
    $name = 'field left blank';
}

if(isset($_POST['exerciseTypeID'])){
    $exerciseTypeID= $_POST['exerciseTypeID'];
}else{
    $exerciseTypeID= 'field left blank';
}

if(isset($_POST['focusID'])){
    $focusID = $_POST['focusID'];
}else{
    $focusID = 'field left blank';
}

if(isset($_POST['isolation'])){
    $isolation = $_POST['isolation'];
}else{
    $isolation = 'field left blank';
}

if(isset($_POST['pushOrPull'])){
    $pushOrPull = $_POST['pushOrPull'];
}else{
    $pushOrPull = 'field left blank';
}
?>
<html>
    <center>
        <?php
            echo( 'Creating Exercise:<br/>
                name: '.$name.'<br/>
                ex Type ID: '.$exerciseTypeID.'<br/>
                focus ID: '.$focusID.'<br/>
                pushOrPull: '.$pushOrPull.'<br/>
                isolation: '.$isolation.'<br/><br/>'
            );
            
            echo('Confirm new exercise entry before submission<br/>');
        ?>

    <div>
        <a href="allEx.php?name=<?php echo $name ?>&focusID=<?php echo $focusID ?>&isolation=<?php echo $isolation ?>&pushOrPull=<?php echo $pushOrPull ?>&exerciseTypeID=<?php echo $exerciseTypeID ?>"><button type="button">Submit Exercise</button></a>
    </div><br/>
    <div>
        <a href="exCreation.php" ><button type="button ">start over</button></a>
    </div></center>
</html>