<?php
function escape($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    $data =  htmlentities($data, ENT_QUOTES, 'UTF,8');
    return $data;
}
?>