<?php  /****   groupCreation.php *****************************************************************************************/
//If all these are set, enter them into the database and go to newGroup.php

if(isset($_GET['message'])){
    $message = $_GET['message'];
    $color = 'red';
}else{
    $message = 'New User Registration';
    $color = 'black';
} ?>

<!DOCTYPE HTML>
<html>
<!--*******************************************gc.php(registration index)***********************************************************-->
    <?php include 'header.php';?>

    <body>
    
        <div class="page">
            <?php include'appBar.php';?>
            <div id="exhibitor">
                <div class="formBox">
                 <br/>
                           <center><font color="<?php echo($color); ?>"><?php echo($message); ?></font></center>                            
                </div>
                <center><form action="newClient.php" method="post">                       
                    <input  type="text" name="firstName" placeholder="First name" autocomplete="off" required/> 
                    <input  type="text" name="lastName" placeholder="Last name" autocomplete="off" required/>
                    <input  type="text" name="nickName" placeholder="Nickname" autocomplete="off" required/> 
                    <input type="date" name="dob" placeholder="Date of Birth" autocomplete="off" required/>
                    <input  type="text" name="zip" placeholder="Zipcode" autocomplete="off" />
                    <input  type="email" name="email" placeholder="Email" autocomplete="off" required/>
                    <input  type="number" size"10" name="mobile" placeholder="Mobile Phone" required/> 
                    <input  type="password" name="auCode" placeholder="Password" required/>
                    <input  type="password" name="auCodeConfirm" placeholder="Confirm Password" required/>
                    <br/>
                    <input type="submit" value="Submit" />
                </form></center>
                <br/>
                <br/>
                <?php include '../footer.php'; ?>
            </div>
        </div>
    </body>
</html>