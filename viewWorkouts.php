<?php
        $clientID = $_SESSION['clientID'];
        /** read in exercises, exercise types and set metrics for each exercise in workoutList for current client  **/
        $query = $db->prepare("SELECT exBlob From workoutList WHERE clientID = '$clientID'") or die("could not query workoutBasket");
        $query->execute();
        $row = $query->fetchAll(PDO::FETCH_ASSOC);
        $count = count($row);
        if($count > 0){
            echo('found exercises');
            foreach($row as $info){
	        //put exercises into a basket for use today 
	            $blob=$info['exBlob'];
             }
        }else{
            echo('user has no workoutBasket');
        }
        
        /**create hashMap called exMap from exBlob**/
        /**start by finding number of exercises and store as length of hash
        Use regex matching to count occurences of 'ex' in exBlob and set that to length of hash**/
        
        
        
        /** store exID as first element in each sub-array of hashmap  **/
        
        /**store exTypeID as second element in each sub-array of hashmap.  This determines number of columns and headers to be created(2 or 3)**/
        /**pull number of sets for each exercise.  This determines number of rows for each exercise  **/
        
        /**show table for creation of workout plan **/
        include('workoutTable.php');
        /******* Store client's workouts from basket in workouts table **/
?>