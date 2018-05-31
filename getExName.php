<?php
function getExName($exID){
        $db = connect();
        $query = $db->prepare("SELECT exName FROM exercises
                               WHERE exID = '$exID'") or die("could not check member");
        $query->execute();
        $row = $query->fetchAll(PDO::FETCH_ASSOC);
                $count = count($row);
                if($count == 1){
                     foreach($row as $info){
        	            $exName=$info['exName'];
                     }
                }
        return $exName;
}
?>