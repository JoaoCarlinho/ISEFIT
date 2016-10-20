<?php
$db = connect();
        $query = $db->prepare("SELECT nickName FROM trainers
                               WHERE trainerID = '$trainerID'") or die("could not check member");
        $query->execute();
        $row = $query->fetchAll(PDO::FETCH_ASSOC);
                $count = count($row);
                if($count == 1){
                     foreach($row as $info){
        	            $trainerName=$info['nickName'];
                     }
                }else{
                    $trainerName = 'auto-generator';
                }
?>