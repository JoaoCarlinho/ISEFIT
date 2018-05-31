<?php
include('xssPrevent.php');
$genExp = "(^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{10,30}$)";
if(isset($_POST['p1'])  && isset($_POST['p2'])){
    $p1 = escape($_POST['p1']);
    $p2 = escape($_POST['p2']);
                                                                                    //$numExp = '/^[A-Za-z0-9._%-]+\d+[A-Za-z]{2,4}$/';
                                                                                    //$specialExp = '/\w*(\$|\*|\^|#|@|~|%|\+|\?|!)+\w*/';
                                                                                    //$upperExp = '/(\\$|\\*|\\^|#|@|~|%|\\+|\\?|!|\w)+([A-Z])+(\\$|\\*|\\^|#|@|~|%|\\+|\\?|!|\w)*/';
                                                                                    //$lowerExp = '(\\$|\\*|\\^|#|@|~|%|\\+|\\?|!|\w)*([a-z])+(\\$|\\*|\\^|#|@|~|%|\\+|\\?|!|\w)*';
                                                                                    //$badExp = '/(\\$|\\*|\\^|#|@|~|%|\\+|\\?|!|\w)*(;|"|\\\'|\|/|<|>|-|=)+(\\$|\\*|\\^|#|@|~|%|\\+|\\?|!|\w)*/';

     if(strlen($p1) < 10 || strlen($p1) > 30){
        echo '<strong style="color:#F00;">password:'.$p1.'must be at least 10 characters no more than 30</strong>';
    }else if(!preg_match($genExp,$p1)){
        // Make sure password has upper and lowercase values, at least 1 number and a special character($, #, @, ~, *, %, +, ?, !, ^)
        echo '<strong style="color:#F00;">password'.$p1.' must contain at least 1 of each:<br/>lowercase, uppercase and number<br/></strong>';
    }
    
    /**else if(!preg_match($specialExp,$p1) || !(preg_match($upperExp, $p1))  || !(preg_match($lowerExp, $p1))){
        // Make sure password has upper and lowercase values, at least 1 number and a special character($, #, @, ~, *, %, +, ?, !, ^)
        echo '<strong style="color:#F00;">password must contain at least 1 of each:<br/> uppercase, number and special character<br/> and begin with lowercase</strong>';
    }elseif(preg_match($badExp,$p1)){
        //make sure no semicolons, quotes, slashes, greater than, less than or dashes can be used as part of a password on ajaxRegistration form
         echo '<strong style="color:#F00;">password must not contain any of the following characters:<br/> \' " ; \ / < > - =</strong>';
    }**/elseif($p1 == $p2){
        echo '<strong style="color:#009900;">passwords match</strong>';
        exit();
    }else{
        echo '<strong style="color:#F00;"> passwords do not match</strong>';
        exit();
    }
    
}else if(isset($_POST['email']) && isset($_POST['passToken']) && isset($_POST['newPassword']) ){
    //test to ensure email is registered AND passToken matches database, and password is valid insert new password
    include_once('connect.php');
    $email = escape($_POST['email']);
    $passToken = escape($_POST['passToken']);
    $newPass = escape($_POST['newPassword']);
    $auCodeDigest = password_hash($newPass, PASSWORD_DEFAULT);
    $db = connect();
        $query = $db->prepare("SELECT firstName FROM clients WHERE email = :email LIMIT 1") or die("could not check member");
        $query ->bindParam(':email', $email, PDO::PARAM_STR);
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        $count = count($result);
        
        //Authenticate customer for current session
        if($count == 1){
            $query = $db->prepare("SELECT firstName FROM clients WHERE email = :email AND newPasswordToken = :passToken LIMIT 1") or die("could not check member");
            $query ->bindParam(':email', $email, PDO::PARAM_STR);
            $query ->bindParam(':passToken', $passToken, PDO::PARAM_STR);
            $query->execute();
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
            $count = count($result);
            
            //Authenticate customer for current session
            if($count == 1){
                // ensure valid password sent
                if(strlen($newPass) < 10 || strlen($newPass) > 30){
                        $message = '<strong style="color:#F00;">password must be at least 10 characters no more than 30</strong>';
                    }else if(!preg_match($genExp,$newPass)){//will eventually use all of these(!preg_match($specialExp,$newPass) || !(preg_match($upperExp, $p1))  || !(preg_match($lowerExp, $p1))){
                        // Make sure password has upper and lowercase values, at least 1 number and a special character($, #, @, ~, *, %, +, ?, !, ^)
                        $message = '<strong style="color:#F00;">password must contain at least 1 of each:<br/> uppercase, lower case, number and special character</strong>';
                    }elseif(preg_match($badExp,$newPass)){
                        //make sure no semicolons, quotes, slashes, greater than, less than or dashes can be used as part of a password on ajaxRegistration form
                         $message = '<strong style="color:#F00;">password must not contain any of the following characters:<br/> \' " ; \ / < > - =</strong>';
                    }else{
                        try{
                            //add new product to product list
                            $updateQuery = ("UPDATE clients 
                                            SET passwordDigest = :newValue
                                            WHERE email = :email AND newPasswordToken = :newPassToken") or die("could not search");
                            $statement = $db->prepare($updateQuery);
                            $statement->bindValue(":newValue", $auCodeDigest);
                            $statement->bindValue(":email", $email);
                            $statement->bindValue(":newPassToken", $passToken);
                            $count = $statement->execute();
                            
                            $message = 'Password successfully updated';
                            
                            $clearToken = ("UPDATE clients 
                                            SET newPasswordToken = :newValue
                                            WHERE email = :email") or die("could not search");
                            $statement = $db->prepare($clearToken);
                            $statement->bindValue(":newValue", 'empty');
                            $statement->bindValue(":email", $email);
                            $count = $statement->execute();
                            
                        }
                        catch(PDOException $e){
                            $message = $e->getMessage();
                        }
                    }
            }else{
                $message = 'invalid token: '.$passToken;
            }
        
        }else{
            $message = 'no user registered with this email';
        }
         $db = null;        // Disconnect
?>
<!DOCTYPE html>
<html lang="en-us">
    <head>
        <meta charset="utf-8">
        <title>Optimizer PassWord Reset</title>  
    </head>
    <body>
        <?php 
        include 'header.php';
        include 'bar.php'; ?>
      	<div class="long_container">
      	    <center>
            <div class="main">
                <?php echo $message; ?>
            </div>
            </center>
	    </div>
	    <?php include 'footer.php'; ?>
    </body>
</html>
<?php
}
?>