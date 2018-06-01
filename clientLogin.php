<?php   include('session.php');    ?>
<!DOCTYPE html>
<html lang="en-us">
    <?php include('header.php'); ?>
    <body>
            <?php /********These are always on the page and used to find out what else to display*******************/
            include('appBar.php');
            ?>
            <div class = "main">
                <form name="login" action="clientLanding.php" method="post" accept-charset="utf-8">  
<<<<<<< HEAD
       <center>
            <table>
=======
       <center><table>
>>>>>>> 297478587b120b121a1bd94d40953e29eea03024
                <tr>
                    <td><label for="usermail">Email</label></td>  
                    <td><input type="email" name="username" placeholder="your@email.com" required></td>
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
            <a href="clientForgotPassword.php">Forgot Password?</a>
        </center>
=======
        </table></center>
>>>>>>> 297478587b120b121a1bd94d40953e29eea03024
            </div>
            <?php
            include('banner.php');
            include('footer.php')
            ?>
    </body>
</html>