<!DOCTYPE html>
<html lang="en-us">

    <head>
        <meta charset="utf-8">
        <title>Verify Account Email Address</title>
        <link rel="stylesheet" href="inventory.css" type="text/css" />
        <link rel="stylesheet" href="productInfo.css" type="text/css" />
        <link rel="stylesheet" href="carousel.css" type="text/css" />
        <link rel="stylesheet" href="global.css" type="text/css" />
        
    </head>
    <body><center>
        <?php include('header.php'); ?>
   
        </div>
      	<div class="container">
			  <h1>Welcome to the Spotter Account Verification!</h1>
                <div id="activation_form">
                    <form action="accountVerification.php" method="post">
                        <input type="text" name="verifyToken" placeholder="verification code"/><br/>
                        <input type="email" name="username" placeholder="Email Adress" /><br/>
                        <input type="password" name="pass" placeholder="Password" /><br/>
                        <input type="radio" name="type" value="0"> Athlete<br>
                        <input type="radio" name="type" value="1"> Coach<br>
                        <input type="submit" value="Verify Email!"/>
                    </form>
                </div>
		</div>
        
        <?php include('footer.php'); ?>    
        
    </center></body>
</html>