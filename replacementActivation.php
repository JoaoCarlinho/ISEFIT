<?php
include('header.php');
include('bar.php');
/*********test to ensure submitted email exists, then send token in an email and update users database record*******/
if(isset($_POST['userName']) && ($_POST['type']==0)){
    /*****check database for email**/
    $userName = $_POST['userName'];
    require ('connect.php');
    $db = connect();
    $query = $db->prepare("SELECT clientID FROM clients
                            WHERE email = '$userName'")or die("Could not check customer info");
    $query->execute();
    $result = $query->fetchAll(PDO::FETCH_ASSOC);
    $count = count($result);
    if($count==1){
        include('randomString.php');
        $randomString = randomString(50);
        $db = connect();
        $query = $db->prepare("UPDATE clients SET activationDigest = '$randomString' WHERE email = '$userName'") or die("could not update activation code");
        $query->execute();
        $db = null;
        include('verifyEmail.php');
?>
        <center>
            <p>Check your inbox to verify your email address and start shopping today!</p>
        </center>
<?php
    }else{
        $db = null;
        echo 'No user registered with that email';
        
    }
    $db = null;
}elseif(isset($_POST['userName']) && ($_POST['type']==1)){
    /*****check database for email**/
    $userName = $_POST['userName'];
    require ('connect.php');
    $db = connect();
    $query = $db->prepare("SELECT trainerID FROM trainers
                            WHERE email = '$userName'")or die("Could not check customer info");
    $query->execute();
    $result = $query->fetchAll(PDO::FETCH_ASSOC);
    $count = count($result);
    if($count==1){
        include('randomString.php');
        $randomString = randomString(50);
        $db = connect();
        $query = $db->prepare("UPDATE trainers SET activationDigest = '$randomString' WHERE email = '$userName'") or die("could not update activation code");
        $query->execute();
        $db = null;
        include('verifyEmail.php');
?>
        <center>
            <p>Check your inbox to verify your email address and start shopping today!</p>
        </center>
<?php
    }else{
        $db = null;
        echo 'No user registered with that email';
        
    }
    $db = null;
}else{
?>
    <center>
    <div id="activation_form">
    Enter your email we'll send replacement Token!
        <form action="replacementActivation.php" method="post">
            <input type="text" name="userName" placeholder="Email Address" /><br/>
            <input type="submit" value=" Get Token"/>
            <input type="radio" name="type" value="0"> Athlete<br>
            <input type="radio" name="type" value="1"> Coach<br>
        </form>
    </div>
    </center>
<?php
}
include('footer.php');

/****Form for requesting new activation token below ******/
?>