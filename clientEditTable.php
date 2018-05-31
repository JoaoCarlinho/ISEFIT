<!DOCTYPE html>
<html lang="en-us">
    <?php include('header.php'); 
                        
    /********************* Dropdown selector Source for all trainers **********************/                   
    $trainerSelector = array();//array for storing database records

    $db = connect();
    $query = $db->prepare("SELECT trainerID, nickName FROM trainers ") or die("could not check member");
    $query->execute();
    $row = $query->fetchAll(PDO::FETCH_ASSOC);
            $count = count($row);
            if($count > 0){
                 foreach($row as $info){
                    $creator[0]=$info['trainerID'];
    	            $creator[1]=$info['nickName'];
    	            $trainerSelector[]=$creator;
                 }
            }
    ?>
    <body><center>
        <form action="clientProfile.php">
            <table>
                <tr><th colspan="2">Update Personal Info</th></tr>
<!--*************** Dropdown selector for trainer nickNames    ------------------------------------------------->             
                <tr>
                    <td>Trainer</td>
                    <td><select id="trainerSelector" name="trainerID" >
                        <option value="<?php echo $cTID; ?>"><?php echo $trainerValue; ?></option>
                           <?php for ($x = 0; $x < count($trainerSelector) ; $x++){ 
                                        echo('<option value="'.$x.'">'.$trainerSelector[$x][1].'</option>');
                                 }
                           ?>
                        </select> 
                    </td>
                </tr>
                <tr><td>Street</td><td><input type="text" name="street" placeholder ="<?php echo $streetValue; ?>"/></td></tr>
                <tr><td>Apt. #</td><td><input type="text" name="streetTwo" placeholder ="<?php echo $streetTwoValue; ?>"/></td></tr>
                <tr><td>City</td><td><input type="text" name="city" placeholder ="<?php echo $cityValue; ?>"/></td></tr>
                <tr><td>State</td><td><input type="text" name="state" placeholder ="<?php echo $stateValue; ?>"/></td></tr>
                <tr><td>Zip Code</td><td><input type="text" name="zip" placeholder ="<?php echo $zipValue; ?>"/></td></tr>
                <tr><td>Cell #</td><td><input type="text" name="mobile" placeholder ="<?php echo $mobileValue; ?>"/></td></tr>
    
            </table>
                        <input type="hidden" name="clientEdit" value="1"/>
                        <input type="submit"/>
        </form><br/><br/>
    </center></body>
</html>