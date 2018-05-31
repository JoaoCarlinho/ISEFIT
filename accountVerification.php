<?php
    require('connect.php');
    $db = connect();
    
    //make sure email, verifyToken and password all match then re-direct to login
    if(isset($_POST['verifyToken']) && isset($_POST['userName']) && isset($_POST['pass']) && ($_POST['type']==0)){
        $randomString = $_POST['verifyToken'];
        $userName = $_POST['userName'];
        $pass = $_POST['pass'];
        
        $query = $db->prepare("SELECT passwordDigest FROM clients WHERE email = '$userName' AND activationD = '$randomString' LIMIT 1") or die("Could not check client info");
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
                $verifyQuery->execute(array(1, $userName));
                $_SESSION['userName'] = $userName;
                $_SESSION['nickName'] = $nickName;
                $_SESSION['customerID'] = $customerID;
                $_SESSION['logged'] = 1;
                $message = 'account activated';
                header('Location: navIndex.php?message='.$message);
            }else{
               echo 'could not verify password';
            }
        }else{
            echo 'invalid user info submitted';
        }       
    }elseif(isset($_POST['verifyToken']) && isset($_POST['userName']) && isset($_POST['pass']) && ($_POST['type']==1)){
        $randomString = $_POST['verifyToken'];
        $userName = $_POST['userName'];
        $pass = $_POST['pass'];
        
        $query = $db->prepare("SELECT passwordDigest FROM trainers WHERE email = '$userName' AND activationD = '$randomString'") or die("Could not check client info");
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
                $verifyQuery->execute(array(1, $userName));
                $_SESSION['userName'] = $userName;
                $_SESSION['nickName'] = $nickName;
                $_SESSION['customerID'] = $customerID;
                $_SESSION['logged'] = 1;
                $message = 'account activated';
                header('Location: trainerIndex.php?message='.$message);
            }else{
               echo 'could not verify password';
            }
        }else{
            echo 'invalid user info submitted';
        } 
    }elseif(isset($_GET['verifyToken']) && isset($_GET['userName'])){
        $verifyToken = $_GET['verifyToken'];
        $userName = $_GET['userName'];
        include('verificationForm.php');
    }else{
?>
    <center>
        <h1>Welcome to the Optimizer Account Verification!</h1>
        <h2>You should have received a verification token in your email.<br> 
           Please check your inbox for your verification email <br>
           click the link to verify your account and continue shopping
        </h2>
        <p>Accidentally delete activation Email?</p>
        <a href="replacementActivation.php">Click here to receive a new activation Token</a>
    </center>
<?php
    }
include('footer.php'); 
?>

    </center></body>
</html>