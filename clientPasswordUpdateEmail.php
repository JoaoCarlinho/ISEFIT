<?					
	//send verification email
	$email_from = "DoNotReply@ISEFitClub.com";
	$email_subject = "Optimizer Password Reset";
	$email_to=$email;
	
	$comments ="ISEFitClub.com Forgotten Password Email\r\n
Click the link below to reset your password and stay fit with ISE Fit\r\n
http://www.planyourlifeexpo.com/sandbox/clientForgotPassword.php?newPasswordToken=".$randomString."&mailID=".$email_to;
    
    $error_message = "";

    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';

      if(!preg_match($email_exp,$email_to)) {
        $error_message .= 'The Email Address you entered does not appear to be valid.<br />';
      }

      if(strlen($error_message) > 0) {die($error_message);}

    function clean_string($string) {
          $bad = array("content-type","bcc:","to:","cc:","href");
          return str_replace($bad,"",$string);
    }
    $email_message = clean_string($comments)."\n";
    
    // To send HTML mail, the Content-type header must be set
    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

    // create email headers
    $headers .= "To:".$email_to."\r\n";
    $headers = "From: ". $email_from ."\r\n";
/** $headers .= 'Cc: birthdayarchive@example.com' . "\r\n";
    $headers .= 'Bcc: birthdaycheck@example.com' . "\r\n";  **/
    mail($email_to, $email_subject, $email_message, $headers);
?>