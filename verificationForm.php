<!DOCTYPE html>
<html lang="en-us"><center>
        <?php include('header.php'); ?>
   
        </div>
      	<div class="container">
			  <h1>Welcome to the Spotter Account Verification!</h1>
                <div id="activation_form">
                    <form action="accountVerification.php" method="post">
                        <input type="hidden" name="verifyToken" value="<?php echo $verifyToken; ?>"/><br/>
                        <input type="hidden" name="userName" value="<?php echo $userName; ?>" /><br/>
                        <input type="password" name="pass" placeholder="Password" /><br/>
                        <input type="radio" name="type" value="0"> Athlete<br>
                        <input type="radio" name="type" value="1"> Coach<br>
                        <input type="submit" value="Verify Email!"/>
                    </form>
                </div>
		</div>
        
        <?php include('footer.php'); ?>    
        
    </center>
</html>
