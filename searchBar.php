<?php
/******************ExSelector.php *****************************/
 //Remove exercises from the workoutBasket at the index from _GET request***************
if(isset($_GET['index'])){
            echo('exercise = '.$_GET['exercise'].', index = '.$_GET['index']);
            //remove exercise from array and workout basket in database
            $sql =("DELETE FROM workoutBasket WHERE exID = ? AND clientID = ?");
            $stmt = $db->prepare($sql);
            $stmt->execute(array($_GET['exID'], $_GET['clientID']));
            
            //Put cart into an array
            $basket = array();
            $query = $db->prepare("SELECT * FROM workoutBasket WHERE clientID = ".$_SESSION['clientID']."") or die("could not shopping carts");
            $query->execute();
            $row = $query->fetchAll(PDO::FETCH_ASSOC);
            $count = count($row);
            //read each returned item's info
             foreach($row as $info){
	        //put exercises into a basket for use today    
	            $creator[0]=$info['exID'];;
	            $creator[1]=$info['exName'];
	            $basket[]=$creator;
             }
}

                                 
if(isset($_GET['newEx'])){
    /***************************First find out if a workout array has been created ******************************/
    
     /**Query workoutBasket for exercisesfor current client***********/
        $query = $db->prepare("SELECT * FROM workoutBasket WHERE clientID = ".$_SESSION['clientID']."") or die("could not shopping carts");
        $query->execute();
        $row = $query->fetchAll(PDO::FETCH_ASSOC);
        $count = count($row);
        if($count > 0){
                //If user has an active basket, put into an array
                $basket = array();
                //read each returned item's info
                 foreach($row as $info){     
    	        //put items into a basket for use today    
    	            $creator[0]=$info['exID'];;
	                $creator[1]=$info['exName'];
    	            $basket[]=$creator;                  
                 }
                 
            //determine if the basket already has a exercise with same ID inside
	        echo 'checking for exercises already in basket ';
            $index = -1;
    	    for($ci=0; $ci<count($basket); $ci++)
    	        if($basket[$ci][1]==$_GET['exID']){
                    echo('exercise exists in basket');
    	            $index=$ci;
    	            break;
    	        }
            //make new row in workoutBasket if no exercise currently in cart with same id
	        if($index==-1){
            
             echo('Putting new exercise in basket for user '.$_SESSION['clientID']);
            //retrieve product info from database
            $query = $db->prepare("SELECT * FROM exercises WHERE exID = ".$_GET['exID']) or die("could not search");
            $query->execute();
            $result = $query->fetchAll(PDO::FETCH_ASSOC);
             //loop through retreived info and assign it to variables
            foreach($result as $info){
               $temp[0]=$info['clientID'];
	           $temp[1]=$info['exID'];
            }
	        $basket[]=$temp;
	        $query = $db->prepare("INSERT INTO workoutBasket (clientID, exID) VALUES(?, ?)") or die("could not search");
            $query->execute(array($_SESSION['clientID'], $info['exID']));
	    }
          
        //add an exercise to an empty basket 
        }else if(isset($_GET['newEX']) && ($count == 0)){
            echo('creating new basket for user'.$_SESSION['clientID'].' adding exercise #'.$_GET['exID'].' to basket!');
        
               echo('No active basket for user');
                //Initialize empty cart
                $basket = array();
                
                $query = $db->prepare("SELECT * FROM exercises WHERE exID = ".$_GET['exID']) or die("could not search");
                $query->execute();
                $result = $query->fetchAll(PDO::FETCH_ASSOC);
                //loop through retreived info and assign it to variables
                foreach($result as $info){
                   $temp[0]=$info['exID'];
                   $temp[1]=$info['exName'];
                }
            $basket[]=$temp;
            $query = $db->prepare("INSERT INTO workoutBasket (clientID, exID) VALUES(?, ?)") or die("could not search");
            $query->execute(array($_SESSION['clientID'], $info['exID']));   
        }
}
?>

<!DOCTYPE html>
<html>
    <body onload="process()">
        <center><h3>the ISE maker</h3>
        <p>Enter the exercise you'd like to add to your workout:</p>
        <input type="text" id="exAdd" />
        <div id="exNote" />
        <div id="exConfirm" />
        <table cellpadding="2" cellspacing="2" border="1">
            <tr>
                <th>option</th><th>Id</th><th>Name</th><th>Price</th><th>Quantity</th><th>Sub Total</th>
            </tr>
            
            <tr>
                <?php
                    $s = 0;
                    
                    for($ci=0; $ci<count($basket); $ci++){
                        $s += $basket[$ci][2] * $basket[$ci][3];
                ?>
                    <tr>
                        <td>Delete(use ajax to remove this line)</td>
                        <td><?php echo $basket[$ci][0]; ?></td><!-- clientID -->
                        <td><?php echo $basket[$ci][1]; ?></td><!-- exName --> 
        
                    </tr>
                <?php   
                    }
                ?>
            </tr>
            <tr>
                <td colspan="4" align="right">Sum</td>
                <td align="left"><?php echo $s; ?></td>
            </tr>
        </table>
        <br>
        <a href ="shoppingcart.php?cartStatus=0&customerID=<?php echo $_SESSION['customerID']?>">create workout!</a>
        </center>
    </body>
</html>