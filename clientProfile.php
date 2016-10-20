<?php  
/***Page for clients to edit personal information.  will include link to page for editing contact info and updating email as well
 * email updates require immediate verification **********/
include('session.php');
    if(isset($_GET['trainerSelector'])){//add new group to directory and send email confirmation
        $trainerInsertID = $_GET['trainerSelector'];
        $query = $db->prepare("INSERT INTO clients (currentTrainerID) VALUES(?)") or die("could not search");
        $query->execute(array($trainerInsertID));
        $db = null;
    }
    if(isset($_GET['street'])){//add new group to directory and send email confirmation
        $street = $_GET['street'];
        $query = $db->prepare("INSERT INTO clients (street) VALUES(?)") or die("could not search");
        $query->execute(array($street));
        $db = null;
    }
    if(isset($_GET['streetTwo'])){
        $streetTwo = $_GET['streetTwo'];
        $query = $db->prepare("INSERT INTO clients (streetTwo) VALUES(?)") or die("could not search");
        $query->execute(array($streetTwo));
        $db = null;
    }
    if(isset($_GET['city'])){
        $city = $_GET['city'];
        $query = $db->prepare("INSERT INTO clients (city) VALUES(?)") or die("could not search");
        $query->execute(array($city));
        $db = null;
    }
    if(isset($_GET['state'])){
        $state = $_GET['state'];
        $query = $db->prepare("INSERT INTO clients (state) VALUES(?)") or die("could not search");
        $query->execute(array($state));
        $db = null;
    }
    if(isset($_GET['zip'])){
        $zip = $_GET['zip'];
        $query = $db->prepare("INSERT INTO clients (zip) VALUES(?)") or die("could not search");
        $query->execute(array($zip));
        $db = null;
    }
    if(isset($_GET['mobile'])){
        $mobile = $_GET['mobile'];
        $query = $db->prepare("INSERT INTO clients (mobile) VALUES(?)") or die("could not search");
        $query->execute(array($mobile));
        $db = null;
    }
                
include('clientProfileView.php');

?>