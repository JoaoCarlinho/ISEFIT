<?php
$logged = $_SESSION['logged'];
$nickname = $_SESSION['nickName'];


    if($logged == 1 ){
        $user_selection = 'logout';
        $login_logout = 'logout.php';
        $register = '#';
        $r='';
        $s="Settings";
        if(isset($_SESSION['username'])){
            $home = 'navIndex.php';
            $accountEdit = 'clientProfile.php';
        }elseif(isset($_SESSION['trainer'])){
            $accountEdit = 'trainerProfile.php';
            $home = 'trainerIndex.php';
        }
        

    }else{
        $user_selection = 'login';
        $login_logout = 'login.php';
        $register = 'register.php';
        $r = 'register';
        $s = '';
        $accountEdit = '#';
    }

?>
        <div class="appBar">
            
                            <h1><div class="app_logo">
                                <?php if($logged==1){ ?>
                                <?php echo ' '.$nickName; ?> Fit
                                        
                                <?php }else{ ?>
                                THE OPTIMIZER
                                <?php } ?>
                            </div></h1>
                                
                            
                                <ul class="appLink"> 
                                    <li><a class="active" href="<?php echo $home; ?>">Home</a></li>
                                    <li class="hide"><a href="#">Help</a></li>
                                    <li class="hide"><a href="<?php echo $login_logout; ?>"><?php echo $user_selection; ?></a></li>
        <?php if($r == 'register')  { ?>
                                    <li class="hide"><a href="<?php echo $register; ?>"><?php echo $r; ?></a></li>
                        <?php       } ?>
        <?php if($s == 'settings')  { ?>
                                    <li class="hide"><a href="<?php echo $accountEdit; ?>"><?php echo $s; ?></a></li>
                        <?php       } ?>
                                    <li class="icon">
                                        <a href="javascript:void(0);" style="font-size:15px;" onclick="myFunction()">☰</a>
                                    </li>
                            
                                </ul>
                            
                            
                            
        </div>