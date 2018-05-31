<?php
require_once('connect.php');
$db = connect();
/*********************************************************Pagination query for all exercises***************************************************/
$query = $db->prepare("SELECT COUNT(exerciseID) FROM exercises") or die("could not display exercises");
        $query->execute();               
/**************************$query->fetchColumn(); returns the total ro count********************************/        
        $rows = $query->fetchColumn();
/****************************Below is the number of results per page*************************/
        $page_rows = 10;
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
/****************************Set the range of rows to query for the chosen $pagenum*********************/
$limit = 'LIMIT ' . ($pagenum - 1) * $page_rows .',' .$page_rows;
/****************************This is the query again for grabbing just one page of rows by applying limit*********************/
$query = $db->prepare("SELECT exerciseID, name, focusID, exerciseTypeID FROM exercises ORDER BY exerciseID DESC $limt") or die("could not display exercises");
$query->execute();
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
        $paginationCtrls .= '<a href="'.$_SERVER['PHP_SELF'].'?pagenum'.$previous.'">Previous</a> $nbsp; $nbsp';
        //Render clickable number link that should appear on the left of the target page number
        for($i = $pagenum-4; $i < $pagenum; $i++){
            if($i > 0){
                $paginationCtrls .= '<a href="'.$_SERVER['PHP_SELF'].'?pagenum'.$i.'">'.$i.'</a> $nbsp; ';
            }
        }
    }
    //Render the target page number, but without it being a link
    $paginationCtrls .= ''.$pagenum.' $nbsp; ';
    
    //Render clickable number links that should appear on the right of the target page number
    for($i = $pagenum+1; $i <= $last_page; $i++){
        $paginationCtrls .= '<a href="'.$_SERVER['PHP_SELF'].'?pagenum'.$i.'">'.$i.'</a> $nbsp; ';
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

$list = '';
$info = $query->fetchAll(PDO::FETCH_ASSOC);
foreach($info as $row)
{
    $exerciseID = $row['exerciseID'];
    $name = $row['name'];
    $focusID = $row['focusID'];
    $exerciseTypeID = $row['exerciseTypeID'];
    /**********Need to create pages with descriptions of each workout***********************/
    $list.='<p><a href="#">'.$exerciseID.' '.$name.' '.$focusID.' '.$exerciseTypeID.' </a> - Click for more info on this exercise </p>';
}
// Close database connection
$db = null;
?>
<!DOCTYPE html>
<html>
    <head>
        <style type="text/css">
            body{ font-family:"Trebuchet MS", Arial, Helvetica, sans-serif;}
            #pagiation_controls{font-size:1.5em;}
            #pagination_controls > a{ color:#06F; }
            #pagination_controls > a:visited{ color:#06F; }
            
        </style>
    </head>
    <body>
           <div>
               <h2><?php echo $textline1; ?> Paged</h2>
               <p><?php echo $textline2; ?></p>
               <p><?php echo $list; ?></p>
               <div id="pagination_controls"><?php echo $paginationCtrls; ?></div>
           </div> 
    </body>
</html>

<?php
/*********************************************************Pagination query for exercises of a specific type***************************************************/
/********$query = $db->prepare("SELECT COUNT(exerciseID) FROM exercises where exerciseTypeID = '$exerciseTypeID'") or die("could not display exercises");
        $query->execute();
        $row = $query->fetchAll(PDO::FETCH_ASSOC);
        $count = count($row);************/
      
?>