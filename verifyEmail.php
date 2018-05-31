<?
	//send verification email
        $email_subject = "Spotter registration confirmation";
        $email_to=$newEmail;
        
        $comments ="
Please click on the link below to activate your account\r\n
http://www.planyourlifeexpo.com/sandbox/accountVerification.php?verifyToken=".$randomString."&userName=".$newEmail;
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
        $email_message = clean_string($comments)."\n";
        
        // To send HTML mail, the Content-type header must be set	
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        
        // create email headers
        $headers .= "To:".$email_to."\r\n";
        $headers .= "From: Spotter Support <". $email_from ."> \r\n";
/**     $headers .= 'Cc: birthdayarchive@example.com' . "\r\n";
        $headers .= 'Bcc: birthdaycheck@example.com' . "\r\n";  **/
        mail($email_to, $email_subject, $email_message, $headers);
?>