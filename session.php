<?php
require('connect.php');
session_start();
$db = connect();
if(isset($_SESSION['username'])){

    if(isset($_POST['ring']) && isset($_POST['username'])){
        $ring = $_POST['ring'];
        $username = $_POST['username'];
        
        //Authenticate client for current session
        $query = $db->prepare("SELECT clientID, email, passwordDigest, activated FROM clients WHERE email = '$username' LIMIT 1") or die("could not check member");
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        $count = count($result);
        
        //verify user
        if($count == 1){
            foreach($result as $info){
                    $activated = $info['activated'];
            }
                if($activated == 0){
                    $message = 'activate your account and get optimized!';
                    header("Location: accountVerification.php?message=".$message);
                }else{
                    $query = $db->prepare("SELECT passwordDigest, nickName, clientID FROM clients WHERE email = '$username'") or die("Could not check client info");
                    $query->execute();
                    $result = $query->fetchAll(PDO::FETCH_ASSOC);
                    $count_query = count($result);
                    if(count==1){
                        foreach($result as $info){
                            $hash = $info['passwordDigest'];
                            $nickName = $info['nickName'];
                            $clientID = $info['clientID'];
                        }
                        $db = null;
                        if(password_verify($pass, $hash)) {
                            session_start();
                            $_SESSION['username'] = $username;
                            $_SESSION['nickName'] = $nickName;
                            $_SESSION['clientID'] = $clientID;
                            $_SESSION['logged'] = 1;
                        }else{
                            $message = 'Invalid password submission';
                            header('Location: accountVerification.php?message='.$message);
                        }
                    
                }
            }
            include('global.php');
                
        }else{
            $logged = 0;
            $message = 'client not authenticated';
            echo $message;
            //exit();
        }
    }else{
        include('global.php');
    } 
}elseif(isset($_SESSION['trainer'])){
    if(isset($_POST['ring']) && isset($_POST['trainer'])){
        $ring = $_POST['ring'];
        $trainer = $_POST['trainer'];
        
        //Authenticate client for current session
        $query = $db->prepare("SELECT trainerID, email, passwordDigest, activated FROM trainers WHERE email = '$trainer'") or die("could not check member");
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        $count = count($result);
        
        //verify user
        if($count == 1){
            foreach($result as $info){
                    $activated = $info['activated'];
            }
            
            if($activated == 0){
                $message = 'activate your account and connect with your clients with the Spotter!';
                header("Location: accountVerification.php?message=".$message);
            }else{
                $query = $db->prepare("SELECT passwordDigest, nickName, trainerID FROM trainers WHERE email = '$trainer'") or die("Could not check client info");
                $query->execute();
                $result = $query->fetchAll(PDO::FETCH_ASSOC);
                $count_query = count($result);
                if(count==1){
                    foreach($result as $info){
                        $hash = $info['passwordDigest'];
                        $trainerID = $info['trainerID'];
                        $nickName = $info['nickName'];
                    }
                    $db = null;
                    if(password_verify($pass, $hash)) {
                        session_start();
                        $_SESSION['trainer'] = $trainer;
                        $_SESSION['trainerID'] = $trainerID;
                        $_SESSION['nickName'] = $nickName;
                        $_SESSION['logged'] = 1;
                    }else{
                        $message = 'Invalid password submission';
                        header('Location: accountVerification.php?message='.$message);
                    }
                
                }
            
            }
            include('global.php');
                
        }else{
            $logged = 0;
            $message = 'client not authenticated';
            echo $message;
            //exit();
        }
    }else{
        include('global.php');
    } 
}else{
    include('global.php');
}
?>