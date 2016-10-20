<?php   
$trainer = $_SESSION['trainer'];
    if($logged == 1){
    
    /*****************************************Show profile image and stats*********************************/
    /**************************************Show up to last 3 completed workouts with pagination for any further workouts*****************************/
    /******************Show next workout to be completed along with the intended completion date ***********************************/    
            $db = connect();
            $query = $db->prepare("SELECT nickname FROM trainers WHERE email = '$trainer'") or die("could not check member");
            $query->execute();
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            $count = count($result);
            foreach($result as $info){
                $nickName = $info['nickname'];
            }?>
            <div><center><?php echo $nickName."! What's happenin?!";?></center></div>
            
        <?php
            include('activeWorkoutRequests.php');
            include('clientList.php');
            include('upcomingSessions.php');
    }else{?>
            <html><center>
            <p>no login info received</p>
            </center></html>
<?php    } 
    
?>