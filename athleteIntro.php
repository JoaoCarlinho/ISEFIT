<!DOCTYPE HTML>
                    <html>
                        <!--*******************************************gc.php(registration index)***********************************************************-->
                        <?php include 'header.php';?>
                    
                        <body>
                        
                            <div class="page">
                                <?php include'appBar.php';?>
                                <div id="exhibitor">
                                    <div style="margin: 80px auto 0 auto;">
                                     <br/>
                                               <center>You are now being optimized with the Spotter!</center>                            
                                    </div>
                                    <center>
                                    <p>Congratulations <?php echo $nickName; ?>! <br/>
                                    
                                    Your activation code has been sent to your email: <?php echo $newEmail; ?><br/>
                                    
                                    Please login into your email and verify your account.<br/>
                                    
                                    We are excited to be a part of your fitness journey!<br/>
                                
                                    If you have any issues, please email support at the following link<br/>
                                    <a href="mailto:isefitclub@gmail.com?Subject=Support%20Request" target="_top">Support</a><br/>
                                    <br/><br/></p>
                                    </center>
                                    
                                    <br/>
                                    <br/>
                                    
                                    <?php include 'footer.php'; ?>
                                </div>
                            </div>
                        </body>
                    </html>