<?php
/*** This page will update every 5 seconds with any queued up exercises ******/
include('connect.php');
$db = connect();

session_start();

If(isset($_SESSION['clientID'])){
    $clientID = $_SESSION['clientID'];
    /******************ExSelector.php *****************************/
    //Remove exercises from the workoutBasket at the index from _GET request***************
    //will need to make more of these for cases where person has not registered
    if(isset($_GET['index'])  && isset($_GET['exID'])){
            echo('exercise = '.$_GET['exercise'].', index = '.$_GET['index']);
            //remove exercise from array and workout basket in database
            $sql =("DELETE FROM workoutBasket WHERE exID = ? AND clientID = ?");
            $stmt = $db->prepare($sql);
            $stmt->execute(array($_GET['exID'], $_SESSION['clientID']));
            
            //Put cart into an array
            $basket = array();
            $creator = array();
            $query = $db->prepare("SELECT exercises.exID, exercises.exName FROM exercises INNER JOIN workoutBasket ON exercises.exID = workoutBasket.exID WHERE workoutBasket.clientID = '$clientID'") or die("could not query workoutBasket");
            $query->execute();
            $row = $query->fetchAll(PDO::FETCH_ASSOC);
            //read each returned item's info
             foreach($row as $info){
	        //put exercises into a basket for use today 
	            $basket[]=$info['exName'];
             }
    }
       /**Query workoutBasket for current client***********/
            $query = $db->prepare("SELECT exercises.exID, exercises.exName FROM exercises INNER JOIN workoutBasket ON exercises.exID = workoutBasket.exID WHERE workoutBasket.clientID = '$clientID'") or die("could not query workoutBasket");
            $query->execute();
            $row = $query->fetchAll(PDO::FETCH_ASSOC);
            $count = count($row);
    
    /**********************************attempt to add new exercise to basket *****************/                                 
    if(isset($_GET['newEx'])){
            if($count > 0){
                    //If user has an active basket, put into an array
                    $basket = array();
                    $creator = array();
                    //read each returned item's info
                     foreach($row as $info){     
        	        //put items into a basket for use today    
        	            $basket[]=$info['exName'];
                     }
                     
                //determine if the basket already has a exercise with same exName inside
    	        echo 'checking exercises already in basket ';
                $index = -1;
        	    for($ci=0; $ci<count($basket); $ci++)
        	        if($basket[ci][1]==$_GET['newEx']){
                        echo('exercise exists in basket');
        	            $index=$ci;
        	            break;
        	        }else if($index==-1){
                //make new row in workoutBasket if no exercise currently in cart with same exName
                     echo('Putting new exercise in basket for user '.$_SESSION['username']);
                    //retrieve product info from database
                    $query = $db->prepare("SELECT exID, exName FROM exercises WHERE exName = ".$_GET['newEx']." LIMT 1") or die("could not search");
                    $query->execute();
                    $result = $query->fetchAll(PDO::FETCH_ASSOC);
                     //loop through retreived info and assign it to variables
                    foreach($result as $info){
        	            $exID=$info['exID'];
        	            $basket[]=$info['exName'];
                    }
        	        $query = $db->prepare("INSERT INTO workoutBasket (clientID, exID) VALUES(?, ?)") or die("could not search");
                    $query->execute(array($_SESSION['clientID'], $exID));
    	        }   
              
            //add an exercise to an empty basket 
            }else if( $count == 0){
                echo('creating new basket for user'.$_SESSION['clientID'].' adding exercise #'.$_GET['newEx'].' to basket!');
                    //Initialize empty cart
                    $basket = array();
                    $creator = array();
                    $query = $db->prepare("SELECT exID,exName FROM exercises WHERE exName = ".$_GET['newEx']) or die("could not search");
                    $query->execute();
                    $result = $query->fetchAll(PDO::FETCH_ASSOC);
                    //loop through retreived info and assign it to variables
                    foreach($result as $info){
                        $exID=$info['exID'];
                        $basket[]=$info['exName'];
                    }
                $_SESSION['basket']=$basket;
                $query = $db->prepare("INSERT INTO workoutBasket (clientID, exID) VALUES(?, ?)") or die("could not search");
                $query->execute(array($_SESSION['clientID'], $exID));   
            }
           include('exTableView.php');
    }else{
        /*****************************page load without request for new addition to basket*******/
            if($count > 0){
                    //user has an active basket, put into an array
                    $basket = array();
                    $creator = array();
                    //read each returned item's info
                     foreach($row as $info){     
        	        //put items into a basket for use today    
    	                $exID=$info['exID'];
                        $basket[]=$info['exName'];
                     }
              
            include('exTableView.php');
            }else{
                echo("Let's start building a new workout!");
            }
    }
}
?>

