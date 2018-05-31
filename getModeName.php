<?php
        $db = connect();
        $query = $db->prepare("SELECT modeName FROM modes
                               WHERE modeID = '$modeID'") or die("could not check member");
        $query->execute();
        $row = $query->fetchAll(PDO::FETCH_ASSOC);
                $count = count($row);
                if($count == 1){
                     foreach($row as $info){
        	            $modeName=$info['modeName'];
                     }
                }
?>