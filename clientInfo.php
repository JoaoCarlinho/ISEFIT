<?php   

$logged = $_SESSION['logged'];
$username = $_SESSION['username'];
    if($logged == 1){ 
    
    /*****************************************Show profile image and stats*********************************/
    /**************************************Show up to last 3 completed workouts with pagination for any further workouts*****************************/
    /******************Show next workout to be completed along with the intended completion date ***********************************/    
            $db = connect();
            $query = $db->prepare("SELECT nickname FROM clients WHERE email = '$username'") or die("could not check member");
            $query->execute();
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            $count = count($result);
            foreach($result as $info){
                $nickName = $info['nickname'];
            }?>
<?php
            
/**************************** replace the pages below with button links***

links allow clients to:
    -view open workout Requests
    -view pastworkouts
    -view stored metrics and info
    -view trending data for specific exercise based on various max estimate theories
    -view trends in one rep max events
    -view sessionandtrainingplaninformation*************/
            include('navWorkoutSelector.php');
            include('openWorkoutRequests.php');
            include('clientOptions.php');
    }else{  
            include('trainingInfo.php');
    }
?>
