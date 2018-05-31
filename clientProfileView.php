<?php  
/***Page for clients to edit personal information.  will include link to page for editing contact info and updating email as well
 * email updates require immediate verification **********/
 ?>
<!DOCTYPE html>
<html lang="en-us">
    <?php include('header.php'); ?>
    <body>
        <div class="container">
            <?php /********These are always on the page and used to find out what else to display*******************/
                include('appBar.php'); 
            ?>
            
            <div class = "main">
                <?php 
                    if($logged==1){
                        $query = $db->prepare("SELECT currentTrainerID, street, streetTwo, city, state, zip, mobile  FROM clients WHERE email = '$username' ") or die("could not search groups");
                        $query->execute();
                        $row = $query->fetchAll(PDO::FETCH_ASSOC);
                        $count = count($row);
                        if($count == 1){
                            foreach($row as $info){
                                $cTID = $info['currentTrainerID'];
                                 /******* Identify current trainer's nickName**********************************/
                                if(is_null($cTID)){
                                    echo('client has no trainer');
                                    $trainerValue = 'select a trainer';
                                }else{
                                    $query = $db->prepare("SELECT nickName FROM trainers WHERE trainerID = '$cTID' ") or die("could not search groups");
                                    $query->execute();
                                    $row = $query->fetchAll(PDO::FETCH_ASSOC);
                                    $count = count($row);
                                    if($count == 1){
                                        foreach($row as $info){
                                            $trainerValue = $info['nickName'];
                                        }
                                    }else{
                                        $trainerValue = 'select a trainer';
                                    }
                                }
                                
                                $street = $info['street'];
                                $streetValue = (is_null($street) ? 'Address 1st line' : $street);
                               
                                $streetTwo = $info['streetTwo'];
                                $streetTwoValue = (is_null($streetTwo) ? 'Address 2nd line' : $streetTwo);
                                
                                $city = $info['city'];
                                $cityValue = (is_null($city) ? 'city' : $city);
                                
                                $state = $info['state'];
                                $stateValue = (is_null($state) ? 'state' : $state);
                                
                                $zip = $info['zip'];
                                $zipValue = (is_null($zip) ? 'zip' : $zip);
                                
                                $mobile = $info['mobile'];
                                $mobileValue = (is_null($mobile) ? 'mobile' : $mobile);
                                
                                include('clientEditTable.php');
                    ?>
                                <center><a href="eContactInfo.php">Emergency Contact Info</a></center>
                    <?php
                                
                            }
                            /*** put together table for update through ajax calls ****/
                            
                        }else{
                            echo('no user info found');
                            
                        }

                    }else{
                        header("Location: logout.php");
                    }?>                    
            </div>    
        </div>
    </body>
</html>