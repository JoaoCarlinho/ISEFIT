<?php
//User verification authentication and persistence       

//ensuring browser sessions set
$db = connect();
session_start();

if(isset($_SESSION['username'])){
        $str = $_SESSION['username'];
        if(strlen($str) <= 1){
                        header("Location: login.php?message=account not activated");
        }    
        $username = $_SESSION['username'];
        //Authenticate customer using current session
        
        $query = $db->prepare("SELECT clientID, nickName, activated FROM clients WHERE email = '$username' LIMIT 1") or die("could not check member");
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        $count = count($result);
        
        //verify user
        if($count > 0){
            foreach($result as $info){
                    $activated = $info['activated'];
                    $clientID = $info['clientID'];
                    $nickName = $info['nickName'];
                }
                $db = null;
            if ($activated == 1){//account verified, log in
                       //log in
                    $_SESSION['logged'] = 1;
                    $_SESSION['clientID'] = $clientID;
                    $_SESSION['nickName'] = $nickName;
            }else{//send verification code to email and ask user to check email for verification code
                    session_destroy();
                    $message = 'account not activated';
                    header("Location: accountVerification.php?message=account not activated");
                    
                     
            }
            
        }else{
            $db = null;
            $logged = 0;
            session_destroy();
            header("Location: login.php?message=invalid user info submitted");
        }
}elseif(isset($_POST['ring']) && isset($_POST['username'])){
    $ring = $_POST['ring'];
    $username = $_POST['username'];
    
    //Authenticate client for current session
    
    $query = $db->prepare("SELECT nickName, activated, passwordDigest FROM clients WHERE email = '$username' LIMIT 1") or die("could not check member");
    $query->execute();
    $result = $query->fetchAll(PDO::FETCH_ASSOC);
    $count = count($result);
    
    //verify user
    if($count == 1){
        foreach($result as $info){
                $activated = $info['activated'];
                $clientID = $info['clientID'];
                $nickName = $info['nickName'];
        }
        if($activated == 0 ){
            $message = 'activate your account and get started';
            header("Location: accountVerification.php?message=$message");
        }else{
            $query = $db->prepare("SELECT passwordDigest FROM clients WHERE email = '$username'") or die("Could not check client info");
                    $query->execute();
                    $result = $query->fetchAll(PDO::FETCH_ASSOC);
                    $count_query = count($result);
                    if($count_query==1){
                        $pass = $_POST['ring'];
                        foreach($result as $info){
                            $hash = $info['passwordDigest'];
                        }
                        if(password_verify($pass, $hash)) {
                            $db = null;
                            $_SESSION['logged'] = 1;
                            $_SESSION['username'] = $username;
                            $_SESSION['clientID'] = $clientID;
                            $_SESSION['nickName'] = $nickName;
                            
                        }else{
                            $db = null;
                            $message = 'Invalid user/password combination';
                            header('Location: login.php?message='.$message);
                        }
                    }
        }
        
            
    }else{
        $db = null;
        $logged = 0;
        session_destroy();
        $message = 'no account for email provided';
        header('Location: register.php?message='.$message);
        
        //exit();
    }
}elseif(isset($_SESSION['trainer'])){
    
        $str = $_SESSION['trainer'];
        if(strlen($str) <= 1){
                        header("Location: login.php?message=account not authenticated");
        }    
        $trainer = $_SESSION['trainer'];
        //Authenticate customer using current session
        
        $query = $db->prepare("SELECT trainerID, nickName, email, activated FROM trainers WHERE email = '$trainer'") or die("could not check member");
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        $count = count($result);
        
        //verify user
        if($count == 1){
            foreach($result as $info){
                $activated = $info['activated'];
                $trainerID = $info['trainerID'];
                $trainer = $info['email'];
                $nickName = $info['nickName'];
            }
            if ($activated == 1){//account verified, log in
                       //log in
                    $_SESSION['logged'] = 1;
                    $_SESSION['trainer'] = $trainer;
                    $_SESSION['trainerID'] = $trainerID;
                    $_SESSION['nickName'] = $nickName;
            }else{//send verification code to email and ask user to check email for verification code
                    session_destroy();
                    $message = 'account not activated';
                    header("Location: accountVerification.php?message=account not activated");
            }
        $db = null;    
        }else{
            $db = null;
            $logged = 0;
            session_destroy();
            header("Location: login.php?message=invalid user info submitted");
        }
}elseif(isset($_POST['ring']) && isset($_POST['trainer'])){
    $ring = $_POST['ring'];
    $trainer = $_POST['trainer'];
    
    //Authenticate client for current session
    
    $query = $db->prepare("SELECT email, nickName, activated, passwordDigest FROM trainers  WHERE email = '$trainer'") or die("could not check member");
    $query->execute();
    $result = $query->fetchAll(PDO::FETCH_ASSOC);
    $count = count($result);
    
    //verify user
    if($count == 1){
        foreach($result as $info){
                $activated = $info['activated'];
                $trainerID = $info['trainerID'];
                $trainer = $info['email'];
                $nickName = $info['nickName'];
        }
        if($activated == 0 ){
                
                $message = 'activate your account and get started';
                header("Location: accountVerification.php?message=".$message);
        }else{
            $query = $db->prepare("SELECT trainerID, passwordDigest FROM trainers WHERE email = '$trainer'") or die("Could not check client info");
                    $query->execute();
                    $result = $query->fetchAll(PDO::FETCH_ASSOC);
                    $count_query = count($result);
                    if($count_query==1){
                        $pass = $_POST['ring'];
                        foreach($result as $info){
                            $hash = $info['passwordDigest'];
                            $trainerID = $info['trainerID'];
                        }
                        if(password_verify($pass, $hash)) {
                            $_SESSION['logged'] = 1;
                            $_SESSION['trainer'] = $trainer;
                            $_SESSION['trainerID'] = $trainerID;
                            $_SESSION['nickName'] = $nickName;
                        }else{
                            $message = 'Invalid user/password combination';
                            header('Location: login.php?message='.$message);
                        }
                    }
                    $db = null;
        }
        
            
    }else{
        $logged = 0;
        session_destroy();
        $message = 'no account for email provided';
        header('Location: register.php?message='.$message);
        
        //exit();
    }
}else{
        
        session_destroy();
   /**     $message = 'please login';
        echo $message;**/
} 
?>