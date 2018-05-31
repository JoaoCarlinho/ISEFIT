<?php  //---------------------------plannedWorkoutStore.php**********************************************

include('getExName.php');
include('connect.php');
header('Content-Type: text/xml');
echo '<?xml version="1.0" encoding="UTF-8" standalone="yes" ?>';
echo '<response>';
if(isset($_POST['id'])  && isset($_POST['newValue'])){
    $workoutBasketLine = $_POST['id'];
    $newValue = $_POST['newValue'];
    //extract workoutID_exID_setIndex_currentValue_adjustmentType
        $strlen = strlen( $workoutBasketLine );
        $dashCount = 0;
        for( $i = 0; $i <= $strlen; $i++ ) {
            $char = substr( $workoutBasketLine, $i, 1 );
            
            if($dashCount == 0){
                    if($char != '_'){
                        $workoutID.=$char;
                    }else{
                        $dashCount += 1;
                    }
            }elseif($dashCount == 1){
                    if($char != '_'){
                        $exID.=$char;
                    }else{
                        $dashCount += 1;
                    }
            }elseif($dashCount == 2){
                    if($char != '_'){
                        $setIndex.=$char;
                    }else{
                        $dashCount += 1;
                    }
            }elseif($dashCount == 3){
                    if($char != '_'){
                        $currentValue.=$char;
                    }else{
                        $dashCount+=1;
                    }
            }
            else{
                        $adjustmentType.=$char;
            }
        }
        
        if($adjustmentType == 'time'){
            $adjustedColumn = 'durationMade';
            $adjustedMetric = 'seconds';
        }elseif($adjustmentType == 'reps'){
            $adjustedColumn = 'repsMade';
            $adjustedMetric = 'reps';
        }elseif($adjustmentType == 'weight'){
            $adjustedColumn = 'weightMade';
            $adjustedMetric = 'lbs';
        }
        $setNumber = $setIndex + 1;
        
        //retrieve exName from database
        $exName = getExName($exID);
            // $char contains the current character, so do your processing here
 //Determine what kind of adjustment is being made(time, reps, weight)   
    //$rest = substr("abcdef", -1);    returns "f"
    $message = 'updating workout #:'.$workoutID.'<br/>'.$adjustmentType.' for
                setNumber '.$setNumber.' of '.$exName.' has been updated <br/>
                from '.$currentValue.' to '.$newValue.' '.$adjustedMetric;
    
        
    echo $message;
    
try{
    $db = connect();
    $updateQuery =  "UPDATE workoutBasket   
                    SET ".$adjustedColumn." = :newValue
                    WHERE workoutID = :workoutID AND exID = :exID AND setIndex = :setIndex";
                     
    $statement = $db->prepare($updateQuery);
    $statement->bindValue(":workoutID", $workoutID);
    $statement->bindValue(":newValue", $newValue);
    $statement->bindValue(":exID", $exID);
    $statement->bindValue(":setIndex", $setIndex);
    $count = $statement->execute();
    
    $db = null;        // Disconnect
}
    catch(PDOException $e) {
    echo $e->getMessage();
}
}else{
    $message = 'no post data received';
    //Value sent for updating an exercise line in workoutbasket
    //Need to create new table(plannedWorkoutBasket which won't be updated here)
    echo $message;
}
echo '</response>';
?>