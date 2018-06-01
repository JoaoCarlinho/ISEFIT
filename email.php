<?php
// multiple recipients
$to  = 'aidan@example.com' . ', '; // note the comma
$to .= 'wez@example.com';

// subject
$subject = 'Birthday Reminders for August';

// message
$message = '
<html>
<head>
  <title>Birthday Reminders for August</title>
</head>
<body><center>
  <p>Congratulations '.$nickName.'
  You are now being optimized with the Spoter,<br/> by ISE Fit</p>
  <p>Questions???<br/>
email: isefitclub@gmail.com</p>
</center></body>
</html>
';

// To send HTML mail, the Content-type header must be set
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

// Additional headers
$headers .= 'To: Mary <mary@example.com>, Kelly <kelly@example.com>' . "\r\n";
$headers .= 'From: Spotter Support <support@example.com>' . "\r\n";
$headers .= 'Reply-To: '.$email_from."\r\n".'X-Mailer: PHP/'.phpversion();
$headers .= 'Cc: birthdayarchive@example.com' . "\r\n";
$headers .= 'Bcc: birthdaycheck@example.com' . "\r\n";

// Mail it
mail($email_to, $subject, $message, $headers);
?>