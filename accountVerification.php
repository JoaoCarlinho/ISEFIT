<?php
    require('connect.php');
    $db = connect();
    
    //make sure email, verifyToken and password all match then re-direct to login
    if(isset($_POST['verifyToken']) && isset($_POST['username']) && isset($_POST['pass']) && ($_POST['type']==0)){
        $randomString = $_POST['verifyToken'];
        $username = $_POST['username'];
        $pass = $_POST['pass'];
        
        $query = $db->prepare("SELECT passwordDigest FROM clients WHERE email = '$username' AND activationD = '$randomString' LIMIT 1") or die("Could not check client info");
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        $count_query = count($result);
        if($count_query==1){
            foreach($result as $info){
                $hash = $info['passwordDigest'];
            }
            if(password_verify($pass, $hash)){
                //update customer info in DB with account activated boolean
                $verifyQuery = $db->prepare("UPDATE clients SET activated=? WHERE email = ?") or die("Could update Account Verification status");
                $verifyQuery->execute(array(1, $username));
                $message = 'acocount activated';
                header('Location: navIndex.php?message='.$message);
            }else{
               echo 'could not verify password';
            }
        }else{
            echo 'invalid user info submitted';
        }       
    }elseif(isset($_POST['verifyToken']) && isset($_POST['username']) && isset($_POST['pass']) && ($_POST['type']==1)){
        $randomString = $_POST['verifyToken'];
        $username = $_POST['username'];
        $pass = $_POST['pass'];
        
        $query = $db->prepare("SELECT passwordDigest FROM trainers WHERE email = '$username' AND activationD = '$randomString'") or die("Could not check client info");
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        $count_query = count($result);
        if($count_query==1){
            foreach($result as $info){
                $hash = $info['passwordDigest'];
            }
            if(password_verify($pass, $hash)){
                //update customer info in DB with account activated boolean
                $verifyQuery = $db->prepare("UPDATE trainers SET activated=? WHERE email = ?") or die("Could update Account Verification status");
                $verifyQuery->execute(array(1, $username));
                $message = 'acocount activated';
                header('Location: trainerIndex.php?message='.$message);
            }else{
               echo 'could not verify password';
            }
        }else{
            echo 'invalid user info submitted';
        } 
    }else{
        include('verificationForm.php');
    
    }
        
?>