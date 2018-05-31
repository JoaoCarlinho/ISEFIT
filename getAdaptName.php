<?php
function getAdaptName($adaptID){
        $db = connect();
        $query = $db->prepare("SELECT adaptName FROM adaptations
                               WHERE adaptationID = '$adaptID'") or die("could not check member");
        $query->execute();
        $row = $query->fetchAll(PDO::FETCH_ASSOC);
                $count = count($row);
                if($count == 1){
                     foreach($row as $info){
        	            $adaptName=$info['adaptName'];
                     }
                }
        return $adaptName;
}
?>