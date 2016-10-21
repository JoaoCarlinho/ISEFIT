$sql = "UPDATE 'workoutBasket'   
                            SET 'workoutID' = :workoutID,
                            'exID' = :exID,
                            'setCount` = :setCount,
                            'setIndex' = :setIndex
                            adaptationID = :adaptationID
                            WHERE `workoutID ` = :workoutID AND 'setCount' = :setCount;";
                        
                        
                         $statement = $db->prepare($sql);
                         $statement->bindValue(":workoutID", $workoutID);
                         $statement->bindValue(":exID", $currentEx);
                         $statement->bindValue(":setCount", $setCount);
                         $statement->bindValue(":setIndex", $x);
                         $statement->bindValue(":adaptationID", $adaptationID);
                         $count = $statement->execute();