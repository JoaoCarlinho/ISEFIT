<?php

include('connect.php');

/********************************************* Section for Tests before Inserting a new client into the Directory***************************************************      **/
if(isset($_GET['ring']) && isset($_GET['firstName']) && isset($_GET['lastName']) && isset($_GET['nickname'])&& isset($_GET['mobile']) && isset($_GET['city']) && isset($_GET['state']) && isset($_GET['zip']) && isset($_GET['email'])){
            $ring = $_GET['ring'];
            $firstName = $_GET['firstName'];
            $lastName = $_GET['lastName'];
            $nickname = $_GET['nickname'];
            $mobile = $_GET['mobile'];
            $cliente = $_GET['email'];
            $city = $_GET['city'];
            $state = $_GET['state'];
            $zip = $_GET['zip'];
            $enrollDate = date('Y-m-d H:i:s');
            
            //activation code
                                        $length = 50;
                                        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                                        $charactersLength = strlen($characters);
                                        $randomString = '';
                                        for ($i = 0; $i < $length; $i++) {
                                            $randomString .= $characters[rand(0, $charactersLength - 1)];
                                        }

/***************************************determine if there is a client stored with the same email*******************************************/
        $db = connect();
        $query = $db->prepare("SELECT email
                               FROM clients 
                               WHERE email = '$cliente'") or die("could not search clients");
        $query->execute();
        $row = $query->fetchAll(PDO::FETCH_ASSOC);
        $count = count($row);
        
        if($count > 0){
                //email already taken , Return to join_form w/ message "email entered already in use:  submit a different email or login with password"
            $message = 'email already in use:  submit a different email or login with password';
            header("Location: join_form.php?message=$message");
        }else{
        //add new client to directory
        echo('New client commited');
             $query = $db->prepare("INSERT INTO clients (firstName, lastName, enrollDate, city, state, zip, mobile, email, aCode, activationD, nickname) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)") or die("could not search");
             $query->execute(array($firstName, $lastName, $enrollDate, $city, $state, $zip, $mobile, $cliente, $ring, $randomString, $nickname));
             
             /***************************************Email confirmation with Email*******************************************/        
                                $email_from = "jerseymetroacademy@gmail.com";
                        		$email_subject = "Optimizer account submission";
                     		    $email_to = $cliente .",". $email_from;
                     
                        		$comments = "
Congratulations ".$firstName."!

You have taken the first step to a healthier lifestyle
Your activationCode is ".$randomString.".
Please use this to activate your account and get started with the optimizer

Get ready to for a life altering experience!
The optimizer is the future of fitness program management.
Get ready to do things you never thought possible.

Questions???  Message: 
Juan Carlo at 614-256-9488 
email: JuanCarlo@isefitclub.com
www.isefitclub.com";
                        
                        		$error_message = "";
                     
                        		$email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
                     
                      		if(!preg_match($email_exp,$cliente)) {
                        			$error_message .= 'The Email Address you entered does not appear to be valid.';
                      		}
                     
                        		
                      		if(strlen($error_message) > 0) {die($error_message);}
                     
                     
                        		function clean_string($string) {
                          			$bad = array("content-type","bcc:","to:","cc:","href");
                          			return str_replace($bad,"",$string);
                        		}
                     
                        		$email_message = clean_string($comments);
                     
                    		// create email headers
                     
                    		$headers = 'From: '. $email_from ."\r".
                     
                    		'Reply-To: '. $email_from ."\r" .
                     
                    		'X-Mailer: PHP/' . phpversion();
                     
                    		mail($email_to, $email_subject, $email_message, $headers);

        }
}

?>
<!DOCTYPE HTML>
<html>
    <!--*******************************************gc.php(registration index)***********************************************************-->
    <?php include '../head.php';?>

    <body>
    
        <div class="page">
            <?php include'../topBar.php';?>
            <div id="exhibitor">
                <div style="margin: 80px auto 0 auto;">
                 <br/>
                           <center>Successful Optimizer Registration!</center>                            
                </div>
                <center><?php
/***************************************Message for registration confirmation*******************************************/
                echo'Congratulations '.$firstName.',<br/>
                You have been optimized!<br/>
                
                Your activation code has been sent to '.$cliente.'<br/>
                
                Grab it and you can begin using your account.<br/>
                
                <br/>
                
                <br/>
                
                <br/>
                
                <br/>
                
                <br/>
                
                <br/>
                
                <br/>
                
                <br/>
                <br/><br/>'; ?></center>
                
                <br/>
                <br/>
                                    
<center><a href="accountActivation.php">Activate Account</a></center>
<br/>
<br/>
                                    <?php include '../footer.php'; ?>
                                </div>
                            </div>
                        </body>
                    </html>