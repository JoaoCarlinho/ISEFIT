<?php   

include('session.php');


function checkForRepeats($exID) {
    $setIndex = 0;
    for($exIndex = $bi; $exIndex>0; $exIndex--){
        if($currentExID == $basket[$exIndex][3]){
            $setIndex++;
        }else{
            break;
        }
    }
}

if(isset($_SESSION['basket'])  && isset($_POST['store']) && isset($_POST['workoutID']) && isset($_POST['complete'])){
    $basket = $_SESSION['basket'];
    $workoutPlan = array();
    $db = connect();
    
    $completion = $_POST['complete'];
    $workoutID = $_POST['workoutID'];
    /***********************check for completion or planning for future date*************************/
    if($completion == 1){
        if(isset($_POST['completeDate']))
                $message = 'Workout completed on '.$completeDate;
                echo "<script type='text/javascript'>alert('$message');</script>";
            if($completeDate == ''){
                $message = "No completion date submitted, so workout can't be marked completed ";
                echo "<script type='text/javascript'>alert('$message');</script>";
            }else{
/******************make sure workout was completed today or on a past date before marking complete*****************/
                $message = 'Workout completed on '.$completeDate;
                echo "<script type='text/javascript'>alert('$message');</script>";
                $sql = "UPDATE workouts   
                SET completeDate = '$completeDate'
                WHERE workoutID = '$workoutID'";
                
                $statement = $db->prepare($sql);
                $store = $statement->execute();
            }
        }else{
            $message = 'must select today or day in past for completion date';
                echo "<script type='text/javascript'>alert('$message');</script>";
            header('Location: navWorkoutPlanner.php?workoutID='.$workoutID);
        }
        
    }else{
        /******************Make sure completion date for workout stored for later is today or in the future************/
    }
    
    /**foreach ($_POST as $name => $val)
{
     echo htmlspecialchars($name . ': ' . $val) . "\n";
}**/
/********* set up planned workoutView from info in workoutBasket**************************/                            
    for($bi = 0; $bi < count($basket); $bi++){//repeat for length of basket  
                $workoutPlanCreator = array();
                $workoutPlanCreator[0]=$basket[$bi][0];/*exName*/
                $workoutPlanCreator[1]=$basket[$bi][1];/*exTypeID*/
            
                $setIndex = 0;
                for($exIndex = $bi-1; $exIndex>=0; $exIndex--){
                    if($basket[$bi][3] == $basket[$exIndex][3]){
                        $setIndex++;
                    }
                }
                $setNumber = $setIndex + 1;
                $setString = $basket[$bi][0].'_set_'.$setNumber;
                $exID = $basket[$bi][3];

                if($basket[$bi][1]==1){//do this when exType is resistance of current exercise
                /*(resistance)(ex1_t1(type)_6(sets)_0s_12r(reps)40lbs_1s_12r_50lbs_2s_12r_60lbs_3s_12r_70lbs_4s12r_80lb*/
        /****************************************put together names of inputs and pull info to save repCounts for repCounts    ************************/
                            $repString = $setString.'_repCount';
                            $weightString = $setString.'_weight';
    
                            $workoutPlanCreator[2]=$setNumber;
                            $workoutPlanCreator[3]= $repsPlan = $_POST[$repString];
                            $workoutPlanCreator[4]= $weightPlan = $_POST[$weightString];
                            $workoutPlan[] = $workoutPlanCreator;
                            $sql = "UPDATE workoutBasket   
                            SET repsPlan = '$repsPlan',
                            weightPlan = '$weightPlan'
                            WHERE exID = '$exID' AND setIndex = '$setNumber'";
                            
                            $statement = $db->prepare($sql);
                            $store = $statement->execute();
                            
                }else if($basket[$bi][1]==2){//do this when exType is timedCardio
                /*(timedCardio)ex2_t2(type)_1(sets)_0s_60sec*/
                            $durationString = $setString.'_duration';
    
                            $workoutPlanCreator[2]=$setNumber;
                            $workoutPlanCreator[3]= $durationPlan =$_POST[$durationString];
                            $workoutPlan[] = $workoutPlanCreator;
                            
                            $sql = "UPDATE workoutBasket   
                            SET durationPlan = '$durationPlan'
                            WHERE exID = '$exID' AND setIndex = '$setNumber'";
                            
                            $statement = $db->prepare($sql);
                            $store = $statement->execute();
        
    
                }else if($basket[$bi][1]==3){//do this when exType is mma
                /*(mma)ex2_t2(type)_1(sets)_0s_60sec_1s_45sec*/
                            $timeString = $setString.'_duration';
    
                            $workoutPlanCreator[2]=$setNumber ;
                            $workoutPlanCreator[3]= $durationPlan = $_POST[$timeString];
                            $workoutPlan[] = $workoutPlanCreator;
                            
                            $sql = "UPDATE workoutBasket   
                            SET durationPlan = '$durationPlan'
                            WHERE exID = '$exID' AND setIndex = '$setNumber'";
                            
                            $statement = $db->prepare($sql);
                            $store = $statement->execute();
    
    
                }else if($basket[$bi][1]==4){//do this when exType is countedCardio
                /*(countedCardio)ex3_t3(type)_1(sets)_0s_60reps_1s_40reps*/
                            $countString = $setString.'_repCount';
    
                            $workoutPlanCreator[2]=$setNumber ;
                            $workoutPlanCreator[3]= $repsPlan = $_POST[$countString];
                            $workoutPlan[] = $workoutPlanCreator;
                            
                            $sql = "UPDATE workoutBasket   
                            SET repsPlan = '$repsPlan'
                            WHERE exID = '$exID' AND setIndex = '$setNumber'";
                            
                            $statement = $db->prepare($sql);
                            $store = $statement->execute();
                }
    }
    
}
include('navStoredWorkoutView.php');
?>

  
  
<?php 
//storeWorkout.php
//This file updates workout table with datePlanned, modeID and completeDate
/** 
    if(isset($_POST['workoutID'])  && isset($_POST['completion']) && isset($_SESSION['clientID']) && isset($_POST['modeID'])){
        $workoutID = $_POST['workoutID'];
        $modeID = $_POST['modeID'];
        $completion = $_POST['completion'];
        $exMap = array();
        
        /** update workouts table for current date with workout sent from workoutList.php**************************************
        notes:
            workouts created by non-trainers can only be independent, so that means modeID will be 1 unless $_SESSION['trainerID'] is set
            default adaptation is weight-loss, will create a dropdown for adjustment to send along with exBlob
            **/
/**        if($completion == 1){/*** update completeDate if workout has been completed  **/
/**            if(isset($_POST['completeDate'])){
                $completeDate = $_POST['completeDate'];
                $sql="UPDATE 'workouts'   
                        SET 'modeID' = :modeID,
                        'completeDate' = :completeDate,
                        WHERE `workoutID ` = :workoutID;";
                        
                        
                         $statement = $db->prepare($sql);
                         $statement->bindValue(":modeID", $modeID);
                         $statement->bindValue(":completeDate", $completeDate);
                         $count = $statement->execute();
                echo 'workout stored';
            }else{
                echo'must enter completion date to stored completed workout';
            }
        }else{/*** update datePlanned if workout is yet to be completed ********/
/**            if(isset($_POST['completeDate'])){
                 $datePlanned = $_POST['completeDate'];
                 $sql="UPDATE 'workouts'   
                        SET 'modeID' = :modeID,
                        'datePlanned' = :datePlanned,
                        WHERE `workoutID ` = :workoutID;";
                        
                        
                         $statement = $db->prepare($sql);
                         $statement->bindValue(":modeID", $modeID);
                         $statement->bindValue(":datePlanned", $datePlanned);
                         $count = $statement->execute();
                echo 'workout stored';
            }else{
               $datePlanned = $_POST['completeDate'];
                 $sql="UPDATE 'workouts'   
                        SET 'modeID' = :modeID,
                        'datePlanned' = :datePlanned,
                        WHERE `workoutID ` = :workoutID;";
                        
                        
                         $statement = $db->prepare($sql);
                         $statement->bindValue(":modeID", $modeID);
                         $statement->bindValue(":datePlanned", $datePlanned);
                         $count = $statement->execute();
                echo 'workout stored';
            }
        }
    }
**/    
   /** 
    
    if(isset($_POST['basket'])){
        $workoutPlan = json_decode(stripslashes($_POST['workoutPlan']), true);
        
        echo count($workoutPlan);
    }
    
    **/
    
?>