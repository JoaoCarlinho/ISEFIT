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

if(isset($_SESSION['basket'])  && isset($_POST['store']) && isset($_POST['workoutID'])){
    /**foreach ($_POST as $name => $val)
{
     echo htmlspecialchars($name . ': ' . $val) . "\n";
}**/
    $workoutID = $_POST['workoutID'];
    
    $fillWorkout = "UPDATE workouts   
            SET filled = 1
            WHERE workoutID = '$workoutID'";
    
    $statement = $db->prepare($fillWorkout);
    $workoutFilled = $statement->execute();
    
    $fillRequest = "UPDATE workoutRequests  
            SET filled = 1
            WHERE workoutID = '$workoutID'";
    
    $statement = $db->prepare($fillWorkout);
    $requestFilled = $statement->execute();

    
    $basket = $_SESSION['basket'];
    $workoutPlan = array();
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
?>
<!DOCTYPE html>
<html lang="en-us">
    <?php include('header.php'); ?>
    <body>
        <div class="container">
            <?php /********These are always on the page and used to find out what else to display*******************/
            include('appBar.php'); 
            ?>
 
            <div class = "main">
                <?php 
                        include('navbar.php');
                ?>
                <center><p>storing workout number <?php echo $workoutID; ?></p>
                <table cellpadding="2" cellspacing="2" border="1">
                <tr><th>Exercise</th><th>Set</th><th>Count</th>  
                
                <?php
                    $resistance = 0;
                    foreach($workoutPlan as $exercise){
                        if($exercise[1] == 1){
                            $resistance = 1;
                        }
                    }
                    if($resistance ==1){
                ?>
                    <th>weight</th></tr>
                <?php
                    }
                ?>
                
                <?php foreach($workoutPlan as $exLine){ ?>
                    <tr>
                        <td><?php echo $exLine[0]; ?></td>
                        <td><?php echo $exLine[2]; ?></td>
                        <td><?php echo $exLine[3]; ?></td>
            <?php      if($exLine[1] == 1){ ?>   
                        <td><?php echo $exLine[4]; ?></td>
            <?php       } ?>
                    </tr>
            <?php   }
            ?>
    </table></center>
            </div>
        </div>
    </body>
</html>
  
  
<?php 
//storeWorkout.php
//This file updates workout table with modeID and updates workoutBasket with durationPlan, or repsPlan and weightPlan


    
   /** 
    
    if(isset($_POST['basket'])){
        $workoutPlan = json_decode(stripslashes($_POST['workoutPlan']), true);
        
        echo count($workoutPlan);
    }
    
    **/
  
?>