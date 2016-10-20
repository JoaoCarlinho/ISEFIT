<?php
//If all these are set, enter them into the database and go to clientProfile.php

/*** make sure to match pass and passConfirm and store as digest*********
 *   make sure birthdate is more than 13 years ago
 *   header to register.php if not all set
    make sure zip is five characters
    make sure phone number is ten characters and reformat******************************
    create password Diget*/
require_once('connect.php');
$db = connect();

if(isset($_POST['firstName']) && isset($_POST['lastName']) && isset($_POST['nickName']) && isset($_POST['gender']) && isset($_POST['dob']) && isset($_POST['zip']) && isset($_POST['email']) && isset($_POST['mobile']) && isset($_POST['auCode']) && isset($_POST['auCodeConfirm'])){
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $nickName = $_POST['nickName'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    
    if(strtotime($dob)<strtotime('-13 year')){
        $dobDisplay = substr($dob, -5);
        $dobDisplay.= '-';
        $dobDisplay.= substr($dob, 0, -6);
    }else{
        $message = 'Registered users must be at least 13 years of age';
        header('Location: trainerRegistration.php?message='.$message);
        exit;
    }
    $zip = $_POST['zip'];
    $newEmail = $_POST['email'];
    $email_exp = '/^[A-Za-z0-9._%-]+@+[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
    if(!preg_match($email_exp , $newEmail)) {
    			$message = 'Please enter a valid email for registration!';
                header("Location: trainerRegistration.php?message=$message");
    }else{
            /***************************************determine if there is an client stored with same email******************************************/
                    $query = $db->prepare("SELECT * FROM trainers WHERE email = '$newEmail' ") or die("could not search groups");
                        $query->execute();
                        $row = $query->fetchAll(PDO::FETCH_ASSOC);
                        $count = count($row);
                    
                    if($count != 0){
                                    //email submitted is not unique, Return to groupCreation w/ message  
                                    $message = 'Someone is already registered wth the email you submitted.';
                                    header("Location: trainerRegistration.php?message=$message");
                    }
    }
    $mobile = $_POST['mobile'];
    $auCode = $_POST['auCode'];
    $auCodeConfirm = $_POST['auCodeConfirm'];
    if($auCode != $auCodeConfirm ){
        $message = 'password and password confirmation must match';
        header('Location: trainerRegistration.php?message='.$message);
        exit;
    }else{
        $auCodeDigest = password_hash($auCode, PASSWORD_DEFAULT);
    }
}else{
    $message = 'Please make sure all requested info is submited';
        header('Location: trainerRegistration.php?message='.$message);
        exit;    
}

include('header.php');
include('appBar.php');

?>
<html lang="en-us">
    <body>

        <center> 
            <p>Please Confirm submission</p>
            <table border="1">
              <tr>
                  <th colspan="2">Account info</th>    
              </tr>
              <tr>
                  <td>Firstname</td><td><?php echo $firstName; ?></td>
              </tr>
              <tr>
                  <td>Lastname</td><td><?php echo $lastName; ?></td>
              </tr>
              <tr>
                  <td>Nickname</td><td><?php echo $nickName; ?></td>
              </tr>
              <tr>
                  <td>Gender</td><td><?php echo $gender; ?></td>
              </tr>
              <tr>
                  <td>Birthdate</td><td><?php echo $dobDisplay; ?></td>
              </tr>
              <tr>
                  <td>ZipCode</td><td><?php echo $zip; ?></td>
              </tr>
              <tr>
                  <td>Email</td><td><?php echo $newEmail; ?></td>
              </tr>
              <tr>
                  <td>Mobile</td><td><?php echo $mobile; ?></td>
              </tr>
            
            </table>
        
            <form action="registered.php" method="post">
                <input type="hidden" name="firstName" value="<?php echo $firstName; ?>"/>
                <input type="hidden" name="lastName" value="<?php echo $lastName; ?>"/>
                <input type="hidden" name="nickName" value="<?php echo $nickName; ?>"/>
                <input type="hidden" name="gender" value="<?php echo $gender; ?>"/>
                <input type="hidden" name="dob" value="<?php echo $dob; ?>"/>
                <input type="hidden" name="zip" value="<?php echo $zip; ?>"/>
                <input type="hidden" name="email" value="<?php echo $newEmail; ?>"/>
                <input type="hidden" name="mobile" value="<?php echo $mobile; ?>"/>
                <input type="hidden" name="auCodeDigest" value="<?php echo $auCodeDigest; ?>"/>
                <input type="submit" value="confirm" />
                
            </form>
        </div>
        
        <a href="navIndex.php" ><button type="button ">Cancel</button></a>
        
    </center></body>
    <?php include 'footer.php'; ?>
</html>