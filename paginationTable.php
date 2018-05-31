<?php
require_once('connect.php');
$db = connect();
/*********************************************************Pagination query for all exercises***************************************************/
$query = $db->prepare("SELECT COUNT(exerciseID) FROM exercises") or die("could not display exercises");
        $query->execute();               
/**************************$query->fetchColumn(); returns the total ro count********************************/        
        $rows = $query->fetchColumn();
/****************************Below is the number of results per page*************************/
        $page_rows = 5;
/*****************************This tells us how many pages we will have *******************/
$last_page = ceil($rows / $page_rows);
/*****************************Ensure there's at least one page *******************/
if($last_page < 1){
    $last_page = 1;
}
/****************************variable for current page number **********************/
$pagenum = 1;
/****************************get pagenum from URL variables if present, otherwise set to 1*********************/
if(isset($_GET['pagenum'])){
    $pagenum = preg_replace('#[^0-9]#', '', $_GET['pagenum']);
}
/****************************Ensure page number isn't below 1, or more than $last_page*********************/
if($pagenum < 1){
    $pagenum = 1;
}elseif($pagenum > $last_page){
    $pagenum = $last_page;
}

/****************************This shows the user what page they are on, and the total number of pages*********************/
$textline1 = "Exercises (<b>$rows</b>)";
$textline2 = "Page <b>$pagenum</b> of <b>$last_page</b>";
/************establish $pagination controls variable *********************/
$paginationCtrls = '';
/****************** If there is more than 1 page worth of results ******************/
if($last_page != 1){
    /**First we check if we're on page one.  If we are, then we don't need a link to 
    the previous page or the first page, so we do nothing. If we aren't then we 
    generate links to the first page, and to the previous page **/
    if($pagenum > 1){
        $previous = $pagenum-1;
        $paginationCtrls .= '<a href="'.$_SERVER['PHP_SELF'].'?pagenum='.$previous.'">Previous</a> &nbsp; &nbsp';
        //Render clickable number link that should appear on the left of the target page number
        for($i = $pagenum-4; $i < $pagenum; $i++){
            if($i > 0){
                $paginationCtrls .= '<a href="'.$_SERVER['PHP_SELF'].'?pagenum='.$i.'">'.$i.'</a> &nbsp; ';
            }
        }
    }
    //Render the target page number, but without it being a link
    $paginationCtrls .= ''.$pagenum.' &nbsp; ';
    
    //Render clickable number links that should appear on the right of the target page number
    for($i = $pagenum+1; $i <= $last_page; $i++){
        $paginationCtrls .= '<a href="'.$_SERVER['PHP_SELF'].'?pagenum='.$i.'">'.$i.'</a> &nbsp; ';
        if($i >= $pagenum+4){
            break;
        }
    }
    //Next button************************************
    if($pagenum != $last_page){
        $next = $pagenum + 1;
        $paginationCtrls .= ' &nbsp; &nbsp; <a href="'.$_SERVER['PHP_SELF'].'?pagenum='.$next.'">Next</a> ';
    }
}
/****************************Set the range of rows to query for the chosen $pagenum*********************/
$limit = 'LIMIT ' . ($pagenum - 1) * $page_rows .',' .$page_rows;

/****************************This is the query again for grabbing just one page of rows by applying limit*********************/
$query = $db->prepare("SELECT exerciseID, name, focusID, exerciseTypeID, pushOrPull, isolation, isoMuscle, primeMovers, secondaryMovers
                       FROM exercises ORDER BY exerciseID DESC $limit") or die("could not display exercises");
        $query->execute();
        $row = $query->fetchAll(PDO::FETCH_ASSOC);
        $count = count($row);
        
        if($count > 0){
/*******************************************exercises found in directory*******************************************/
                $directory = array();
                //read each returned exercise's info
                 foreach($row as $info){     
    	        //put items into a basket for use today    
    	            $creator[0]=$info['exerciseID'];
                    $creator[1]=$info['name'];
/********************translation of focus ID to focus Area******************/                    
                    if($info['focusID'] == 1){
                        $focusArea = 'full body';    
                    }elseif($info['focusID'] == 2){
                        $focusArea = 'core';    
                    }elseif($info['focusID'] == 3){
                        $focusArea = 'upper body';                            
                    }elseif($info['focusID'] == 4){
                        $focusArea = 'lower body';                            
                    }
    	            $creator[2]=$focusArea;
/********************translation of exerciseTypeID to text ******************/                                         
                    if($info['exerciseTypeID'] == 1){
                        $exerciseTypeID = 'resistance';    
                    }elseif($info['exerciseTypeID'] == 2){
                        $exerciseTypeID = 'cardio';    
                    }elseif($info['exerciseTypeID'] == 3){
                        $exerciseTypeID = 'mma';    
                    }
    	            $creator[3]=$exerciseTypeID;
/********************translation of pushorPull to text ******************/                                         
                    if($info['pushOrPull'] == 1){
                        $pushOrPull = 'pushing';    
                    }elseif($info['pushOrPull'] == 2){
                        $pushOrPull = 'pulling';    
                    }
    	            $creator[4]=$pushOrPull;
/********************translation of isolation to text ******************/                                         
                    if($info['isolation'] == 1){
                        $isolation = 'Yes';    
                    }elseif($info['isolation'] == 2){
                        $isolation = 'No';    
                    }                    
    	            $creator[5]=$isolation;
                    if($info['isoMuscle'] == 0){
                        $isoMuscle = 'No Value entered';    
                    }else{
                        $isoMuscle = $info['isoMuscle'];    
                    }
    	            $creator[6]=$isoMuscle;
                    if($info['primeMovers'] == 0){
                        $primeMovers = 'No Value entered';    
                    }else{
                        $primeMovers = $info['primeMovers'];    
                    }
    	            $creator[7]=$primeMovers;
                    if($info['secondaryMovers'] == 0){
                        $secondaryMovers = 'No Value entered';    
                    }else{
                        $secondaryMovers = $info['secondaryMovers'];    
                    }
    	            $creator[8]=$secondaryMovers;
    	            $directory[]=$creator;                  
                 }
        }else{
            echo('Exercise table empty');
        }
        // Close database connection
        $db = null;
?>
<html>
    <head>
        <style type="text/css">
            body{ font-family:"Trebuchet MS", Arial, Helvetica, sans-serif;}
            #pagiation_controls{font-size:1.5em;}
            #pagination_controls > a{ color:#06F; }
            #pagination_controls > a:visited{ color:#06F; }
            
        </style>
    </head>
    <div><h2><?php echo $textline1; ?> Paged</h2>
               <p><?php echo $textline2; ?></p>
    </div>
    <center><table cellpadding="2" cellspacing="2" border="1">
        <tr>
            <th>Exercise ID</th>
            <th>Name</th>
            <th>Focus Area</th>
            <th>Exercise Type</th>
            <th>Push or Pull</th>
            <th>Isolation?</th>
            <th>IsoMuscle ID</th>
            <th>Prime Movers</th>
            <th>Secondary Movers</th>
        </tr>
    
        <tr>
            <?php
                $s = 0;
            
                for($ci=0; $ci<count($directory); $ci++){
                    $s += $directory[$ci][2] * $directory[$ci][3];
                    $index = $ci;
            ?>
            <tr>
                <td><?php echo $directory[$ci][0]; ?></td><!--exercise ID -->
                <td><?php echo $directory[$ci][1]; ?></td><!-- name --> 
                <td><?php echo $directory[$ci][2]; ?></td><!-- focus area --> 
                <td><?php echo $directory[$ci][3];  ?></td><!-- exercise Type -->
                <td><?php echo $directory[$ci][4]; ?></td><!-- pushOrPull --> 
                <td><?php echo $directory[$ci][5];  ?></td><!-- isolation -->
                <td><?php echo $directory[$ci][6];  ?></td><!-- isoMuscle -->
                <td><?php echo $directory[$ci][7];  ?></td><!-- primeMovers -->
                <td><?php echo $directory[$ci][8];  ?></td><!-- secondaryMovers -->
            </tr>
            <?php 
            }
            ?>
        </tr>
    
    </table></center><br/>
    <center><div id="pagination_controls"><?php echo $paginationCtrls; ?></div></center>
</html>
