<?php
require_once('connect.php');
$db = connect();

/*************************************************** Directory exercises *************************************************/
$query = $db->prepare("SELECT exID, name, focusID, exerciseTypeID, pushOrPull, isolation, isoMuscle, primeMovers, secondaryMovers
                       FROM exercises") or die("could not display exercises");
        $query->execute();
        $row = $query->fetchAll(PDO::FETCH_ASSOC);
        $count = count($row);
        
        if($count > 0){
/*******************************************exercises found in directory*******************************************/
                $directory = array();
                //read each returned exercise's info
                 foreach($row as $info){     
    	        //put items into a basket for use today    
    	            $creator[0]=$info['exerciseID'];
                    $creator[1]=$info['name'];
/********************translation of focus ID to focus Area******************/                    
                    if($info['focusID'] == 1){
                        $focusArea = 'full body';    
                    }elseif($info['focusID'] == 2){
                        $focusArea = 'core';    
                    }elseif($info['focusID'] == 3){
                        $focusArea = 'upper body';                            
                    }elseif($info['focusID'] == 4){
                        $focusArea = 'lower body';                            
                    }
    	            $creator[2]=$focusArea;
/********************translation of exerciseTypeID to text ******************/                                         
                    if($info['exerciseTypeID'] == 1){
                        $exerciseTypeID = 'resistance';    
                    }elseif($info['exerciseTypeID'] == 2){
                        $exerciseTypeID = 'cardio';    
                    }elseif($info['exerciseTypeID'] == 3){
                        $exerciseTypeID = 'mma';    
                    }
    	            $creator[3]=$exerciseTypeID;
/********************translation of pushorPull to text ******************/                                         
                    if($info['pushOrPull'] == 1){
                        $pushOrPull = 'pushing';    
                    }elseif($info['pushOrPull'] == 2){
                        $pushOrPull = 'pulling';    
                    }
    	            $creator[4]=$pushOrPull;
/********************translation of isolation to text ******************/                                         
                    if($info['isolation'] == 1){
                        $isolation = 'Yes';    
                    }elseif($info['isolation'] == 2){
                        $isolation = 'No';    
                    }                    
    	            $creator[5]=$isolation;
                    if($info['isoMuscle'] == 0){
                        $isoMuscle = 'No Value entered';    
                    }else{
                        $isoMuscle = $info['isoMuscle'];    
                    }
    	            $creator[6]=$isoMuscle;
                    if($info['primeMovers'] == 0){
                        $primeMovers = 'No Value entered';    
                    }else{
                        $primeMovers = $info['primeMovers'];    
                    }
    	            $creator[7]=$primeMovers;
                    if($info['secondaryMovers'] == 0){
                        $secondaryMovers = 'No Value entered';    
                    }else{
                        $secondaryMovers = $info['secondaryMovers'];    
                    }
    	            $creator[8]=$secondaryMovers;
    	            $directory[]=$creator;                  
                 }
        }else{
            echo('Exercise table empty');
        }
?>
<html>
    <center><table cellpadding="2" cellspacing="2" border="1">
        <tr>
            <th>Exercise ID</th>
            <th>Name</th>
            <th>Focus Area</th>
            <th>Exercise Type</th>
            <th>Push or Pull</th>
            <th>Isolation?</th>
            <th>IsoMuscle ID</th>
            <th>Prime Movers</th>
            <th>Secondary Movers</th>
        </tr>
    
        <tr>
            <?php
                $s = 0;
            
                for($ci=0; $ci<count($directory); $ci++){
                    $s += $directory[$ci][2] * $directory[$ci][3];
                    $index = $ci;
            ?>
            <tr>
                <td><?php echo $directory[$ci][0]; ?></td><!--exercise ID -->
                <td><?php echo $directory[$ci][1]; ?></td><!-- name --> 
                <td><?php echo $directory[$ci][2]; ?></td><!-- focus area --> 
                <td><?php echo $directory[$ci][3];  ?></td><!-- exercise Type -->
                <td><?php echo $directory[$ci][4]; ?></td><!-- pushOrPull --> 
                <td><?php echo $directory[$ci][5];  ?></td><!-- isolation -->
                <td><?php echo $directory[$ci][6];  ?></td><!-- isoMuscle -->
                <td><?php echo $directory[$ci][7];  ?></td><!-- primeMovers -->
                <td><?php echo $directory[$ci][8];  ?></td><!-- secondaryMovers -->
            </tr>
            <?php 
            }
            ?>
        </tr>
    
    </table></center><br/>
</html>
