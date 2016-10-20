<?php  
/***Page for clients to edit personal information.  will include link to page for editing contact info and updating email as well
 * email updates require immediate verification **********/
include('session.php');    ?>
<!DOCTYPE html>
<html lang="en-us">
    <?php include('header.php'); ?>
    <body>
        <div class="container">
            <?php /********These are always on the page and used to find out what else to display*******************/
                include('appBar.php'); 
                include('banner.php');
            ?>
            
            <div class = "main">
                <?php 
                    if($logged==1){
                        $query = $db->prepare("SELECT eContactFirst, eContactLast, eContactMobile, eContactEmail, eContactRelationship FROM clients WHERE email = '$username' ") or die("could not search groups");
                        $query->execute();
                        $row = $query->fetchAll(PDO::FETCH_ASSOC);
                        $count = count($row);

                    }else{
                        header("Location: accountActivation.php?message=$message");
                    }?>                    
            </div>    
            <?php include('footer.php')?>
        </div>
    </body>
</html>