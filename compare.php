<?php /****************************************registered.php    Parent Registration Confirmation***********************************************************************************************************/
require_once('connect.php');
$db = connect();

/********************************************* Section for Tests before Inserting a new group into the Directory***************************************************      **/
if(isset($_POST['firstName']) && isset($_POST['lastName']) && isset($_POST['nickName']) && isset($_POST['dob']) && isset($_POST['zip']) && isset($_POST['email']) && isset($_POST['mobile']) && isset($_POST['auCodeDigest'])){
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $nickName = $_POST['nickName'];
    $postDateFormat = $_POST['dob'];
    $zip = $_POST['zip'];
    $dob = $_POST['dob'];
    $enrollDate = date("Y-m-d H:i:s");
    $newEmail = $_POST['email'];
    $auCodeDigest = $_POST['auCodeDigest'];
            $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
            if(!preg_match($email_exp , $newEmail)) {
    			$message = 'Please enter a valid email for registration!';
                header("Location: navIndex.php?message=$message");
            }else{
                    /***************************************determine if there is an client stored with same email******************************************/
                            $query = $db->prepare("SELECT * FROM clients WHERE email = '$newEmail' ") or die("could not search groups");
                                $query->execute();
                                $row = $query->fetchAll(PDO::FETCH_ASSOC);
                                $count = count($row);
                            
                            if($count != 0){
                                            //email submitted is not unique, Return to groupCreation w/ message  
                                            $message = 'Someone is already being spotted wth email you submitted.';
                                            header("Location: register.php?message=$message");
                            }else{
                                        //create ActivationCode
                                        $length = 30;
                                        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                                        $charactersLength = strlen($characters);
                                        $randomString = '';
                                        for ($i = 0; $i < $length; $i++) {
                                            $randomString .= $characters[rand(0, $charactersLength - 1)];
                                        }
                            
                                        //add new group to directory and send email confirmation
                                        $query = $db->prepare("INSERT INTO clients (firstName, lastName, nickName, birthDate, zip, email, passWordDigest, enrollDate, activationD) VALUES( ?, ?, ?, ?, ?, ?, ?, ?, ?)") or die("could not search");
                                        $query->execute(array($firstName, $lastName, $nickName, $dob, $zip, $newEmail, $auCodeDigest, $enrollDate, $randomString));
                    
                                        $db = null;
                            }
                            
                                                /***************************************Email confirmation with contactEmail*******************************************/        
                                $email_from = "ISEFitClub@gmail.com";
                        		$email_subject = "Spotter registration confirmation";
                     		    $email_to = $newEmail .",". $email_from;
                     
                        		$comments = '
                                <html>
                                    <head>
                                      <title>Birthday Reminders for August</title>
                                    </head>
                                    <center><body>
                                        <p>Congratulations '.$nickName.'
                                        You are now being optimized with the Spoter,<br/> by ISE Fit</p>
                                        <p>Copy the code below to activate your account</p>
                                        <p>'.$randomString.'</p>
                                        <p>Questions???<br/>
                                        email: isefitclub@gmail.com</p>
                                    </body></center>
                                </html>
                                ';
                        
                        		$error_message = "";
                     
                        		$email_exp = '/^[A-Za-z0-9._%-]+@+[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
                     
                          		if(!preg_match($email_exp,$newEmail)) {
                            			$error_message .= 'The Email Address you entered does not appear to be valid.';
                          		}
                     
                        		
                      		    if(strlen($error_message) > 0) {die($error_message);}
                     
                     
                        		function clean_string($string) {
                          			$bad = array("content-type","bcc:","to:","cc:","href");
                          			return str_replace($bad,"",$string);
                        		}
                     
                        		$email_message = clean_string($comments);
                     
                        		// create email headers
                                $headers  = 'MIME-Version: 1.0' . "\r\n";
                                $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    
                        		$headers .= 'To:'.$email."\r\n";
                                $headers .= 'From: Spotter Support <'.$email_from.'>' . "\r\n";
                                $headers .= 'Reply-To: '.$email_from."\r\n".'X-Mailer: PHP/'.phpversion();
                         
                        		mail($email_to, $email_subject, $email_message, $headers);
                                
            }
}else{
    $message = 'Please ensure all requested info is submitted!';
    header("Location: register.php?message=$message");
}
                        
?>         
                                    
                                    
                                
                    <!DOCTYPE HTML>
                    <html>
                        <!--*******************************************gc.php(registration index)***********************************************************-->
                        <?php include 'header.php';?>
                    
                        <body>
                        
                            <div class="page">
                                <?php include'appBar.php';?>
                                <div id="exhibitor">
                                    <div style="margin: 80px auto 0 auto;">
                                     <br/>
                                               <center>You are now being optiized with the Spotter!</center>                            
                                    </div>
                                    <center>
                                    <p>Congratulations <?php echo $nickName; ?>! <br/>
                                    
                                    Your activation code has been sent to your email: <?php echo $newEmail; ?><br/>
                                    
                                    Please login into your email and verify your account.<br/>
                                    
                                    We are excited to be a part of your fitness journey!<br/>
                                
                                    If you have any issues, please email support at the following link<br/>
                                    <a href="mailto:isefitclub@gmail.com?Subject=Support%20Request" target="_top">Support</a><br/>
                                    <br/><br/></p>
                                    </center>
                                    
                                    <br/>
                                    <br/>
                                    
                                    <?php include 'footer.php'; ?>
                                </div>
                            </div>
                        </body>
                    </html>
