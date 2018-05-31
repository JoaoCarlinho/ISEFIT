<?php
include('connect.php');
include('xssPrevent.php')
?>
<!DOCTYPE html>
<html lang="en-us">
    <head>
        <meta charset="utf-8">
        <title>Login to The Optimizer</title>  
    </head>
    <body>
        <?php 
        include 'header.php';
        include 'bar.php'; ?>
      	<div class="long_container">
      	    <center>
<?php
if(isset($_GET['mailID']) && isset($_GET['newPasswordToken']) ){
    //test to ensure email is registered, then insert new password
    $email = escape($_GET['mailID']);
    $passToken = escape( $_GET['newPasswordToken']);
?>
        <div class="main">
            <center>
            <div class="customerLoginBox"><br/>
                    <span id="status"></span>
                    <div id="signUpInfo">
                            <form method="post" name="signupForm" action="trainerPasswordUpdate.php" style="width:300px;">                       
                                <table>
                                        <tr>
                                            <td>
                                                    <input  type="email" maxlength="30" name="email" id="email" placeholder="email" required onkeyup="checkCustomers()" onfocus="emptyElement('status')" onblur="restrict('email')"/>
                                            </td>
                                            <td>
                                                    <div id="emailAlerts"></div>
                                            </td>
                                        </tr> 
                                        <tr>
                                            <td>
                                                    <input  type="password" maxlength="30" name="pass1" id="p1" placeholder="Password" required onkeyup="matchPass();" onfocus="emptyElement('status')"/>
                                            </td>
                                            <td>
                                                    <div id="passwordAlerts1"></div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                    <input  type="password" maxlength="30" name="newPassword" id="p2" placeholder="Confirm Password" required onkeyup="matchPass()" onfocus="emptyElement('status')"/>
                                            </td>
                                            <td>
                                                    <div id="passwordAlerts"></div>
                                            </td>
                                        </tr>
    
                                        <tr>
                                            <td colspan="2">
                                                    
                                                            <button style="border:1px solid #CCC" id="newPassBtn" type="button"><input type="submit" value="Confirm"/></button>
                                            </td>
                                        </tr>
                                </table>
                                <input type="hidden" name="passToken" value="<?php echo $passToken; ?>" />
                                <input type="hidden" value="<?php echo $email; ?>" />
                            </form>
                    </div>
                    
            </div>
            </center>
        </div>
<?php    
}else if(isset($_POST['email'])){
    $email = $_POST['email'];
    //test to ensure email is registered, create newPassWordToken, embed in en email
    $db = connect();
        $query = $db->prepare("SELECT trainerFirstName FROM trainers WHERE email = :email LIMIT 1") or die("could not check member");
        $query ->bindParam(':email', $email, PDO::PARAM_STR);
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        $count = count($result);
        
        //Authenticate customer for current session
        if($count == 1){
            include('randomString.php');
            $randomString = randomString(30);
            try{
                //add new product to product list
                $updateQuery = ("UPDATE trainers 
                                SET newPasswordToken = :newValue
                                WHERE email = :email") or die("could not search");
                $statement = $db->prepare($updateQuery);
                $statement->bindValue(":newValue", $randomString);
                $statement->bindValue(":email", $email);
                $count = $statement->execute();
                
                $db = null;        // Disconnect
                $message = 'check your email for a password reset link';
            }
            catch(PDOException $e){
                $message = $e->getMessage();
            }
            include('trainerPasswordUpdateEmail.php');
        }else{
            $message = 'no trainer registered with this email';
        }
?>
            <div class="main">
                <?php echo $message; ?>
            </div>
<?php
}else{

?>
      	     <div class="main">
    		  <h1>Welcome to the Optimizer</h1>
                  <p>Enter your email below and submit to receive a password reset link</p>
                <center>    
                    <div class="customerLoginBox">
                       <form action="trainerForgotPassword.php" method="post">
                           <input type="text" name="email" placeholder="Enter Email"/><br/>
                            <input type="submit" name="submit" />
                       </form>
                    </div>
                </center>
            </div>
<?php
}
?>
            </center>
	    </div>
	    <?php include 'footer.php'; ?>
    </body>
</html>
<script>
_('newPassBtn').style.display = "none";
function matchPass(){
    //Make sure length of password is at least 10 characters and no more than 30
    var p1 = _('p1').value;
    var p2 = _('p2').value;
    var n = p1.length;
    
                                                   /** var numExp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
                                                    var specialExp = '/\w*(\$|\*|\^|\#|\@|\~|\%|\+|\?|\!)+\w*/';
                                                   // var upperExp = '/(\$|\*|\^|\#|\@|\~|\%|\+|\?|\!|\w)*([A-Z])+(\$|\*|\^|\#|\@|\~|\%|\+|\?|\!|\w)*/';
                                                    //var lowerExp = '(\$|\*|\^|\#|\@|\~|\%|\+|\?|\!|\w)*([a-z])+(\$|\*|\^|\#|\@|\~|\%|\+|\?|\!|\w)*';
                                                    //var badExp = '/(\$|\*|\^|\#|\@|\~|\%|\+|\?|\!|\w)*(\;|\"|\'|\\|\/|\<|\>|\-|\=)+(\$|\*|\^|\#|\@|\~|\%|\+|\?|\!|\w)*/';
                                                    
                                                   /** var numMatch = p1.match(numExp);
                                                    var specMatch = p1.match(specialExp);
                                                    var upMatch = p1.match(upperExp);
                                                    var lowMatch = p1.match(lowerExp);
                                                    var badMatch = p1.match(badExp);
                                                    **/
        if(n < 10 || n >30){
            _("passwordAlerts1").innerHTML = '<strong style="color:#009900;">password must be at least 10 characters, no more than 30</strong>';
        }/**else if( specMatch.length ==0 || upMatch.length == 0 || lowMatch.length == 0){
            // Make sure password has upper and lowercase values, at least 1 number and a special character($, #, @, ~, *, %, +, ?, !, ^)
            _("passwordAlerts1").innerHTML ='<strong style="color:#F00;">password must contain at least 1 of each:<br/> uppercase, lower case, number and special character</strong>';
        }else if(badMatch.length > 0){
            //make sure no semicolons, quotes, slashes, greater than, less than or dashes can be used as part of a password on ajaxRegistration form
             _("passwordAlerts1").innerHTML = '<strong style="color:#F00;">password must not contain any of the following characters:<br/> \' " ; \ / < > - =</strong>';
        }**/else if(p2 != ''){
                _("passwordAlerts1").innerHTML = '';
                _('passwordAlerts').innerHTML = 'checking passwords';
                var ajax = ajaxObj("POST", "trainerPasswordUpdate.php");
                ajax.onreadystatechange = function(){
                        if(ajaxReturn(ajax) == true){
                                _("passwordAlerts").innerHTML = ajax.responseText;
                        }
                        if(ajax.responseText == '<strong style="color:#009900;">passwords match</strong>'){
                            _('newPassBtn').style.display = "block";
                        }
                };
                ajax.send("p1"+p1+"&p2="+p2);
        }
}
</script>