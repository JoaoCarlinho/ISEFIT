<?php /****************************************registered.php   Spotter Registration Confirmation***********************************************************************************************************/
require_once('connect.php');
$db = connect();

/********************************************* Section for Tests before Inserting a new client/Trainer into the Directory***************************************************      **/
if(isset($_POST['firstName']) && isset($_POST['lastName']) && isset($_POST['nickName']) && isset($_POST['gender']) && isset($_POST['dob']) && isset($_POST['zip']) && isset($_POST['email']) && isset($_POST['mobile']) && isset($_POST['auCodeDigest'])){
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $nickName = $_POST['nickName'];
    $gender = $_POST['gender'];
    $postDateFormat = $_POST['dob'];
    $zip = $_POST['zip'];
    $dob = $_POST['dob'];
    $enrollDate = date("Y-m-d H:i:s");
    $newEmail = $_POST['email'];
    $auCodeDigest = $_POST['auCodeDigest'];
            $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
            if(!preg_match($email_exp , $newEmail)) {
    			$message = 'Please enter a valid email for registration!';
                header("Location: register.php?message=$message");
<<<<<<< HEAD
                exit;
=======
>>>>>>> 297478587b120b121a1bd94d40953e29eea03024
            }else{
                    /***************************************determine if there is an client stored with same email******************************************/
                            $query = $db->prepare("SELECT * FROM trainers WHERE email = '$newEmail' ") or die("could not search groups");
                                $query->execute();
                                $row = $query->fetchAll(PDO::FETCH_ASSOC);
                                $count = count($row);
                            
                            if($count != 0){
                                            //email submitted is not unique, Return to groupCreation w/ message  
                                            $message = 'Someone is already registered wth email you submitted.';
                                            header("Location: trainerRegistration.php?message=$message");
<<<<<<< HEAD
                                            exit;
=======
>>>>>>> 297478587b120b121a1bd94d40953e29eea03024
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
                                        $query = $db->prepare("INSERT INTO trainers (trainerFirstName, trainerLastName, nickName, gender, birthDate, zip, email, passWordDigest, enrollDate, activationD) VALUES( ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)") or die("could not search");
                                        $query->execute(array($firstName, $lastName, $nickName, $gender, $dob, $zip, $newEmail, $auCodeDigest, $enrollDate, $randomString));
                    
                                        $db = null;
<<<<<<< HEAD
                                        
                                        //send verification email
                                        include('verifyEmail.php');
=======
                            
                            
                                                /***************************************Email confirmation with contactEmail*******************************************/        
                                $email_from = "ISEFitClub@gmail.com";
                        		$email_subject = "Spotter registration confirmation";
                     		    $email_to = $newEmail .",". $email_from;
                     
                        		$comments = '
                                <html>
                                    <head>
                                      <title>Registration Successful</title>
                                    </head>
                                    <center><body>
                                        <p>Congratulations '.$nickName.'
                                        You are now ready to optimize your clients with the Spotter,
                                        <br/> by ISE Fit</p>
                                        <p>Copy the code below  and login to activate your account</p>
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
>>>>>>> 297478587b120b121a1bd94d40953e29eea03024
                            }
                include('trainerIntro.php');
            }
    
}elseif(isset($_POST['firstName']) && isset($_POST['lastName']) && isset($_POST['nickName']) && isset($_POST['dob']) && isset($_POST['zip']) && isset($_POST['email']) && isset($_POST['mobile']) && isset($_POST['auCodeDigest'])){
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
                header("Location: register.php?message=$message");
<<<<<<< HEAD
                exit;
=======
>>>>>>> 297478587b120b121a1bd94d40953e29eea03024
            }else{
                    /***************************************determine if there is an client stored with same email******************************************/
                            $query = $db->prepare("SELECT * FROM clients WHERE email = '$newEmail' ") or die("could not search groups");
                                $query->execute();
                                $row = $query->fetchAll(PDO::FETCH_ASSOC);
                                $count = count($row);
                            
                            if($count != 0){
                                            //email submitted is not unique, Return to groupCreation w/ message  
                                            $message = 'Someone is already being spotted with email you submitted.';
                                            header("Location: register.php?message=$message");
<<<<<<< HEAD
                                            exit;
=======
>>>>>>> 297478587b120b121a1bd94d40953e29eea03024
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
<<<<<<< HEAD
                                        
                                        //send verification email
                                        include('verifyEmail.php');
=======
                            
                            
                                                /***************************************Email confirmation with contactEmail*******************************************/        
                                $email_from = "ISEFitClub@gmail.com";
                        		$email_subject = "Spotter registration confirmation";
                     		    $email_to = $newEmail .",". $email_from;
                     
                        		$comments = '
                                <html>
                                    <head>
                                      <title>Registration Successful</title>
                                    </head>
                                    <center><body>
                                        <p>Congratulations '.$nickName.'
                                        You are now being optimized with the Spotter,<br/> by ISE Fit</p>
                                        <p>Copy the code below  and login to activate your account</p>
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
>>>>>>> 297478587b120b121a1bd94d40953e29eea03024
                            }  
                include('athleteIntro.php');
            }
}else{
    $message = 'Please ensure all requested info is submitted!';
    header("Location: register.php?message=$message");
<<<<<<< HEAD
    exit;
=======
>>>>>>> 297478587b120b121a1bd94d40953e29eea03024
}
                        
?>         
