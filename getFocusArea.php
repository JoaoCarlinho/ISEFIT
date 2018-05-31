<?php
$db = connect();
        $query = $db->prepare("SELECT focusArea FROM focusAreas
                               WHERE focusID = '$focusID'") or die("could not check member");
        $query->execute();
        $row = $query->fetchAll(PDO::FETCH_ASSOC);
                $count = count($row);
                if($count == 1){
                     foreach($row as $info){
        	            $focusArea=$info['focusArea'];
                     }
                }
?>