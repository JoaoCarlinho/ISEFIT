<?php   include('session.php');    ?>
<!DOCTYPE html>
<html lang="en-us">
    <?php include('header.php'); ?>
    <body>
        <div class="container">
            <?php /********These are always on the page and used to find out what else to display*******************/
            include('appBar.php');
            ?>
 
            <div class = "main">
                <form name="login" action="trainerIndex.php" method="post" accept-charset="utf-8">  
       
                <center><table>
                <tr>
                    <td><label for="usermail">Email</label></td>  
                    <td><input type="email" name="trainer" placeholder="your@email.com" required></td>
                </tr>
                <tr>
                    <td><label for="password">Password</label></td>  
                    <td><input type="password" name="ring" placeholder="password" required></td>  
                </tr>
                <tr>
                    <td colspan="2" style="background:#cce6ff;"><center><input type="submit" value="Login"></center></td>
                </tr>
                </form>
<<<<<<< HEAD
                </table>
                <a href="trainerForgotPassword.php">Forgot Password?</a></center>
=======
                </table></center>
>>>>>>> 297478587b120b121a1bd94d40953e29eea03024
            </div>
            <?php
            include('banner.php');
            include('footer.php')
            ?>
        </div>
    </body>
</html>

