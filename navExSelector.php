<?php   include('session.php');
        include('getAdaptName.php');
        /*************************************** This page will add exercises to the workoutBasket by sending workoutID, exName, setCount and adaptation in $_POST with session client ID******************************/
$db = connect();

/**This page accepts focus and adaptation and assign it to a new workout, or accept workoutID to update given workout ID 
      A workoutBasekt line will be created for eqch set of each exercise submitted**/
      
/*****************************************************remove exercise from workoutBasket***********************************************/
    if(isset($_SESSION['clientID']) && isset($_GET['index']) && isset($_GET['exID']) && isset($_GET['workoutID'])){
/*******************************************Ensure this person is authorized to edit workouts for this clientID***********/
        include('workoutEditAuth.php');
/****************Go to ExInserter to remove this exercise from workoutBasket for this workoutID**************/
        include('navExInserter.php');
        
    }elseif(isset($_SESSION['clientID']) && isset($_POST['adaptID']) && isset($_POST['focusID']) && isset($_POST['datePlanned'])){
/*****************************************************Create a new workout***********************************************/       
        $clientID = $_SESSION['clientID'];
        $datePlanned = $_POST['datePlanned'];
        $adaptID = $_POST['adaptID'];
        $adaptName = getAdaptName($adaptID);
        $focusID = $_POST['focusID'];
        include('getFocusArea.php');
        $createDate = date("Y-m-d H:i:s");
/********************create new workoutID here and assign createDate, focus, adaptation and clientID*******************/ 
        $query = $db->prepare("SELECT MAX(workoutID) AS MaxID FROM workouts") or die("could not query workouts for highest ID");
        $query->execute();
        $row = $query->fetchAll(PDO::FETCH_ASSOC);
        $count = count($row);
        if($count == 1){
            
            foreach($row as $info){
                $oldMax = $info['MaxID'];
            }
            /*** research the result of a max function on an empty table ******/
            $workoutID = $oldMax + 1;
            $workoutMessage = 'new workout number: '.$workoutID
            ?>
            <center><?php echo "<script type='text/javascript'>alert('$workoutMessage');</script>"; ?></center>
        
        <?php
            
        }
/*********************update workouts table with new workout for client*****************/        
        $query = $db->prepare("INSERT INTO workouts (workoutID, createDate, clientID, adaptation, focus, datePlanned) VALUES(?, ?, ?, ?, ?, ?)") or die("could not search");
        $query->execute(array($workoutID, $createDate, $clientID, $adaptName, $focusArea, $datePlanned));
        
        
        
    }elseif(isset($_SESSION['clientID']) && isset($_POST['exID']) && isset($_POST['setCount']) && isset($_POST['adaptID']) && isset($_POST['workoutID'])){
/*********************************************************add exercise to existing workout******************************/        
        include('workoutEditAuth.php');
        /***insert new exercise into basket********/
        $workoutID = $_POST['workoutID'];
        include('navExInserter.php');
    }elseif(isset($_GET['workoutID'])  && isset($_SESSION['clientID'])){
/**********************************open existing workout for addition of exercises**************************************/
            $workoutID = $_GET['workoutID'];
            $clientID = $_SESSION['clientID'];
            
            $query = $db->prepare("SELECT workouts.clientID, workouts.datePlanned, workouts.adaptation
                                    FROM workouts 
                                    WHERE workouts.clientID = '$clientID' AND workouts.workoutID = '$workoutID'") or die("could not query workoutBasket");
            $query->execute();
            $row = $query->fetchAll(PDO::FETCH_ASSOC);
            $count = count($row);
            if($count != 1){
                $db = null;
                header('Location: navIndex.php');
            }else{
                foreach($row as $info){
                    $datePlanned = $info['datePlanned'];
                    $adaptation = $info['adaptation'];
                }
                
            }
    }else{
        $db = null;
        header('Location: navIndex.php?message=no_workoutID_here');
    }
    
    $logged = $_SESSION['logged'];
    
    if($logged == 1){
        $list = array();
    
        /*****************************************Show profile workout requests that have not yet been filled*********************************/
        $query = $db->prepare("SELECT adaptation, modeID, focus, datePlanned
                               FROM workouts 
                               WHERE workoutID = '$workoutID'") or die("could not check member");
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        $count = count($result);
        if($count > 0){
            foreach($result as $info){
                $modeID = $info['modeID'];
                $list[0] = $info['adaptation'];
                $list[1] = $info['focus'];
                $list[2] = $info['datePlanned'];
            }
            include('getModeName.php');
            
        } 
    }$db = null;
    /*******************set post value for workoutID****************************************/
?>
<!DOCTYPE html>
<html>
    <?php include('header.php'); ?>
    
    <body >
         <div class="container">
            <?php /********These are always on the page and used to find out what else to display*******************/
            include('appBar.php'); 
            ?>
 
            <div class = "main">
                <center><div style="border:solid 1px #000000;"><h3>the ISE maker</h3>
                
                <center>Workout #<?php echo $workoutID; ?>
    <table cellpadding="2" cellspacing="2" border="1">
        <tr>
            <th>Mode</th><th>adaptation</th><th>focus</th><th>Date</th>
        </tr>
        
        <tr>
                <tr>
                    <td><?php echo $modeName; ?></td><!-- mode -->
                    <td><?php echo $list[0]; ?></td><!-- adaptation -->
                    <td><?php echo $list[1]; ?></td><!-- focus -->
                    <td><?php echo $list[2]; ?></td><!-- datePlanned -->
                </tr>
        </tr>
    </table>
    <br/>
    <br/>
    </center>
                
                <form action="navExSelector.php" method="post">
                   <input type="hidden" name="workoutID" value="<?php echo $workoutID; ?>"/>
                    <?php
/********************************************View for inserting new workouts to an open workoutBasket****************************/
                    include('adaptSelector.php'); 
                    ?>
        <!--******************************************autocomplete for Exercise Name*******************-------------------------------------------->
                    <p>Enter the exercise you'd like to add to workout #<?php echo $workoutID; ?>:</p>
                    <?php include('exSelector.php') ?>
        <!--******************************************input for rep count**********************************----------------------------------------->
                    <p>Enter the number of sets for this exercise:</p>
                    <?php include('getSetCount.php'); ?><br/>
              
            <!-- the bottom below with onClick="queueEx(); with ajax for single page functionality-->
                    <input class="createWorkoutButton" type="submit" value="add Exercise!"/>
                </form>
                    <p id="queueStatus"></p>
                </div></center>
                <?php include('navUpcomingBasket.php'); ?>
            </div>
        </div>
    </body>
</html>