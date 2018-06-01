<!--  associate index of each exercise in basket with exTypeID and create inputs for rep/time and weights for each   

First step is to find the length of $basket

The number of rows in the table will be = count($basket)
once inside of each row, pull out exName, exTypeID, and set number inside of each row
-->
<<<<<<< HEAD
<?php include('getAdaptName.php'); ?>
<center>
    <p>Workout Number: <?php echo $workoutID; ?></p>
    <table cellpadding="2" cellspacing="2" border="1" bordercolor="#66ccff" bgcolor="#66ccff">
        <tr>
            <th>Adaptation</th><th>Mode</th><th>Focus Area</th><th>workout Date</th>
        </tr>
            
        <a href="navExSelector.php?workoutID=<?php echo $workoutID; ?>">
            <tr>
                <td><?php echo $adaptation; ?></td><!-- adaptation -->
                <?php
                include('getModeName.php'); 
                ?>
                <td><?php echo $modeName; ?></td><!-- mode ID -->
                <td><?php echo $focus; ?></td><!-- focus -->
                <td><?php echo $workoutDate; ?></td><!-- datePlanned -->
            </tr>
        </a>
    </table>
    <br/>
    <form action="navStoreWorkout.php" method="post">
        <input type="hidden" name="store" value="1"/>
        <input type="hidden" name="workoutID" value="<?php echo $workoutID ?>"/>
        <p>Confirm your workout detalis</p>
        <p>Exercises:</p>
                        <table cellpadding="2" cellspacing="0" border="1" bordercolor="#ffffff" bgcolor="#66ccff" id="exChart">
                            <tr>
                                <th>exName</th><th >set</th><th >duration(sec or reps)</th><?php
                                        $resistance = 0;
                                        foreach($basket as $exercise){
                                            if($exercise[1] == 1){
                                                $resistance = 1;
                                            }
                                        }
                                        if($resistance ==1){
                                    ?>
                                        <th >weight(lbs)</th></tr>
                                    <?php
                                        }else{ ?>
                                            </tr>
                                <?php   }
                            $numEX = count($basket);
                            foreach($basket as $exLine){
                                            ?>
                                            <tr id="<?php echo $workoutID.'_'.$exLine[3].'_'.$exLine[2]; ?>">
                                                <?php if ($exLine[2] == 0){ 
                            /**************************Put exName and adaptation in first column for each exercise*************************/
                                                $adaptName = getAdaptName($exLine[8]);
                                                ?>
                                                <td  rowspan="<?php echo $exLine[7] ?>"><?php echo $exLine[0].' as '.$adaptName; ?></td><!-- exName -->
                                                                    <?php    } ?>
                            <!--**************************list setNumber for this exercise(not editable)*************************-------------------------------->
                                                <td class="setNumber" ><?php echo $exLine[2] + 1; ?></td><!-- setNumber ( equals setIndex + 1 -->
                                        <?php if($exLine[1] == 1 || $exLine[1] == 1){ ?>
                            <!--**************************list number of reps for this set(editable)*************************-------------------------------->
                            <!--*****Clicking on this makes it editable.  onChange will send update to plannWorkoutUpdater with, workoutID, exID, setIndex, currentValue and adjustmentType to update workoutBasket-->
                                                <td class="repDurWei"  onClick="editWorkout('<?php echo $workoutID.'_'.$exLine[3].'_'.$exLine[2].'_'.$exLine[5].'_reps'; ?>')"  onChange="loadDoc('<?php echo $workoutID.'_'.$exLine[3].'_'.$exLine[2].'_'.$exLine[5].'_reps'; ?>')"><input type="number" id="<?php echo $workoutID.'_'.$exLine[3].'_'.$exLine[2].'_'.$exLine[5].'_reps'; ?>" value="<?php echo $exLine[5]; ?>"/></td><!-- reps -->
                                        <?php   }else{ ?>
                            <!--**************************list duration for this set(editable)*************************-------------------------------->
                            <!--*****Clicking on this makes it editable.  onChange will send update to plannWorkoutUpdater with workoutID exID, setIndex, currentValue and adjustmentType to update workoutBasket-->
                                                <td class="repDurWei" onClick="editWorkout('<?php echo $workoutID.'_'.$exLine[3].'_'.$exLine[2].'_'.$exLine[4].'_time'; ?>')" onChange="loadDoc('<?php echo $workoutID.'_'.$exLine[3].'_'.$exLine[2].'_'.$exLine[4].'_time'; ?>')"><input type="number" id="<?php echo $workoutID.'_'.$exLine[3].'_'.$exLine[2].'_'.$exLine[4].'_time'; ?>" value="<?php echo $exLine[4]; ?>"/></td><!-- duration -->
                                        <?php   } ?>
                                        <?php    if($exLine[1] == 1){
                                                    ?>
                            <!--**************************list weight for this set(editable)*************************-------------------------------->
                            <!--*****Clicking on this makes it editable.  onChange will send update to plannWorkoutUpdater with workouID, exID, setIndex, currentValue and adjustmentType  to update workoutBasket-->
                                                        <td class="repDurWei" onClick="editWorkout('<?php echo $workoutID.'_'.$exLine[3].'_'.$exLine[2].'_'.$exLine[6].'_weight'; ?>')" onChange="loadDoc('<?php echo $workoutID.'_'.$exLine[3].'_'.$exLine[2].'_'.$exLine[6].'_weight'; ?>')"><input type="number" id="<?php echo $workoutID.'_'.$exLine[3].'_'.$exLine[2].'_'.$exLine[6].'_weight'; ?>" value="<?php echo $exLine[6]; ?>"/></td><!-- weight -->
                                                        </tr><!--******************delete removes this setNumber for this exID and workoutID from workoutBasket and updates setCount to be one less, then re-inputs everything else---------------->
                                                    <?php
                                                        }else{ ?>
                                                            </tr><!--******************delete removes this setNumber for this exID and workoutID from workoutBasket and updates setCount to be one less, then re-inputs everything else---------------->
                                                    <?php    }
                            }                        
                                                    ?>
                    
                        </table>
                        <br/>
                        <br/>
                        <div id="updateNote"></div>
                            <br/>
=======
<center>
    <form action="navStoreWorkout.php" method="post">
        <input type="hidden" name="store" value="1"/>
        <input type="hidden" name="workoutID" value="<?php echo $workoutID ?>"/>
        <p>Enter your workout detalis</p>
        <table border="1" cellspacing="0">
            <tr>
                <th>exercise</th><th>set</th><th colspan="2">info</th>
            </tr>
                <tr>
                    
                    <?php for($bi=0; $bi<count($basket); $bi++){ /*********************$bi represents how many exercise lines are in basket*******/
                        $setIndex = 0;
                        for($exIndex = $bi - 1; $exIndex>=0; $exIndex--){
                            if($basket[$bi][3] == $basket[$exIndex][3]){
                                $setIndex++;
                            }
                        }
                    ?>
                        <tr>
                            <?php   $setNumber = $setIndex + 1;
                                    $setString = $basket[$bi][0].' set '.$setNumber;
                                    
                                    if($setNumber == 1){
                            ?>
                                    <td rowspan="<?php echo $basket[$bi][2]; ?>"><?php echo $basket[$bi][0]; ?></td><!-- exName -->
                            <?php   } ?>
                            <td><?php echo $setNumber; ?></td><!-- exName and set number -->
                            <td><?php /** input fields based on exTypeID (columns) and number of sets(rows)**/
                                if( $basket[$bi][1] == 1){     ?>
    <!----------------------------if exTypeID is 1(create an columns for weight and reps for each set(row)---------------------------------------->
                                   
                                   <table cellpadding="2" cellspacing="2" border="1">
                                       <tr><th>weight</th><th>reps</th></tr>
                                                   <?php   $weightInput = $setString.' weight';
                                                           $repCountInput = $setString.' repCount';?>
                                           <tr><td><input type="text" id="<?php echo $weightInput;?>" name="<?php echo $weightInput;?>" value="weight"></td><td><input type="text" id="<?php echo $repCountInput;?>" name="<?php echo $repCountInput;?>"  value="reps"></td></tr>
                                                                   
                             <!--                         Finding out the names of the input boxes                                          -->                                      
                                                            <?php/**   echo '<script language="javascript">';
                                                                    echo 'alert("'.$repCountInput.'"+" for rep input "+"'.$weightInput.'"+" for weight input" )';
                                                                    echo '</script>';**/
                                                            ?>
                                       
                                       
                                   </table>
                        <?php   }else if( $basket[$bi][1] == 2){     ?>
    <!-----------------------------if exTypeID is 2(create one column for duration of each set(row)----------------------------------------------->
                                   
                                   <table cellpadding="2" cellspacing="2" border="1">
                                       <tr><th>time</th></tr>
                                                   <?php $timeInput= $setString.' duration';?>
                                           <tr><td><input type="text" id="<?php echo $timeInput;?>" name="<?php echo $timeInput;?>" value="seconds"></td></tr>
                             <!--                         Finding out the names of the input boxes                                          -->                                      
                                                            <?php/**   echo '<script language="javascript">';
                                                                    echo 'alert("'.$timeInput.'"+" for time input" )';
                                                                    echo '</script>';**/
                                                            ?>          
                                       
                                   </table> 
                        <?php   }else if( $basket[$bi][1] == 3){    ?>
    <!-------------------------------if exTypeID is 3(create one column for duration of each set(row)---------------------------------------------->
                                   
                                   <table cellpadding="2" cellspacing="2" border="1">
                                       <tr><th>duration</th></tr>
                                                       <?php $timeInput= $setString.' duration';?>
                                           <tr><td><input type="text" id="<?php echo $timeInput;?>" name="<?php echo $timeInput;?>" value="seconds"></td></tr>
                             <!--                         Finding out the names of the input boxes                                          -->                                      
                                                            <?php/**   echo '<script language="javascript">';
                                                                    echo 'alert("'.$timeInput.'"+" for time input" )';
                                                                    echo '</script>';**/
                                                            ?>           
                                       
                                       
                                   </table> 
                        <?php   }else if( $basket[$bi][1] == 4){    ?>
    <!-------------------------------if exTypeID is 4(create one column for count of each set(row)------------------------------------------------->
                                   
                                   <table cellpadding="2" cellspacing="2" border="1">
                                       <tr><th>count</th></tr>
                                                       <?php $repCountInput = $setString.' repCount';?>
                                           <tr><td><input type="text" id="<?php echo $repCountInput;?>" name="<?php echo $repCountInput;?>" value="reps"></td></tr>
                             <!--                         Finding out the names of the input boxes                                          -->                                      
                                                            <?php/**   echo '<script language="javascript">';
                                                                    echo 'alert("'.$repCountInput.'"+" for rep input" )';
                                                                    echo '</script>';**/
                                                            ?>           
                                       
                                       
                                   </table>
                        <?php   } ?>   
                            </td>
                        </tr>
                    <?php }
                            $numEx = count($basket);
                    ?>
                </tr>
        </table><br>
>>>>>>> 297478587b120b121a1bd94d40953e29eea03024
    
        <input type="radio" name="mode" value="3" checked>Independent Workout<br>
        <input type="radio" name="mode" value="2">Personal Training<br>
        <input type="radio" name="mode" value="1" checked>Group Training<br><br>
    
<<<<<<< HEAD
=======
        <input type="radio" name="complete" value="1" checked>Workout Complete<br>
        <input type="radio" name="complete" value="0">Planned for a later date<br>
        
>>>>>>> 297478587b120b121a1bd94d40953e29eea03024
        <div id="date">
            <label for="date">Completion date</label>
            <input type="date" name="completeDate" id="completeDate">
        </div><br/>
        <!-- will use onclick="javascript: buildWorkout()" -->
        <input class="createWorkoutButton" type="submit" value="Store Workout!"/>
    </form>
    <p id="status">This will update upon successful storage of your workout</p>
    <a href="clientWorkouts.php"><div class="createWorkoutButton">View Completed Workouts</div></a>
</center>
<!-- the create workout button should build the exBlob using the values in basket 
combined with the values in the inputs for each exercise  -->


<script type="text/javascript">
<<<<<<< HEAD

function editWorkout(id){
    document.getElementById(id).contentEditable = true;
}



//%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%  AJAX Functions%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%

function loadDoc(id){
    var xmlHttp;
    var url = 'plannedWorkoutStorer.php';
    var id = id;
    var newValue = document.getElementById(id).value;
    xmlHttp = new XMLHttpRequest();
    xmlHttp.onreadystatechange = function() {
        if(this.readyState==4  && this.status == 200){
                document.getElementById("updateNote").innerHTML = this.responseText;
                
        }
    };
    xmlHttp.open("POST", url,  true);
    xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlHttp.send("id="+id+"&newValue="+newValue);
} 
=======
/*******************************fuction to include date selector if user indicates they've completed the current workout**************/
function checkCompletion(){
    var radios = document.getElementsByName('complete');

        if(radios[1].checked) {
            // hide selector is second radio box checked
            document.getElementById(date).style.display = 'none';
        }else if(radio[0].checked){
            document.getElementById(date).style.display = 'block';
        }
    
    setTimeout(checkCompletion(), 1000);
}
>>>>>>> 297478587b120b121a1bd94d40953e29eea03024


/****************Find all exercises in the workoutBasket for the current client (using session client) and add number of sets to them */
    var workoutID = <?php echo json_encode($workoutID); ?>;
    var exBlob = "";
    var numEx = <?php echo json_encode($numEx); ?>;
    var workoutPlan= [];
    
function buildWorkout(){
    var workoutPlanCreator ={};
    var exBlob = "";
    var numEx = <?php echo json_encode($numEx); ?>;
    var jBasket= <?php echo json_encode($basket); ?>;
    
    var xHRO = createXmlHttpRequestObject();

    function createXmlHttpRequestObject(){
        var xHRO;
    
        if(window.XMLHttpRequest){
            try{
                xHRO = new XMLHttpRequest();
            }catch(e){
                xHRO = false;
            }
        }else{
            try{
                xHRO = new ActiveXObject("Microsoft.XMLHTTP");
            }catch(e){
                xHRO = false;
            }
        }
    
        if(!xHRO){
                alert("Exercise not added");
        }else{
                return xHRO;
        }       
    }
    
    function jsObject2phpObject(object){
        var json ="{";
        for(property in object) {
            var value = object[property];
            if(typeof(value) == "string"){
                json += '"' +property+ '" : "' +value+ '",';
            }else{
                if(!value[0]){//if it's an associative array
                    json += '"' +property+ '":' +jsObject2phpObject(value) + ',';
                }else{
                    json += '"' +property+ '":[';
                    for(prop in value) json += '"' +value[prop]+'",';
                    json = json.substr(0,json.length-1) + "],";
                }
            }
        }
        return json.substr(0,json.length-1) + "}";
    }

    /*for(var i=0; i < numEx;i++){
        //alert(jBasket[i][2]+" sets of "+jBasket[i][0])+ "s ";
        alert(jBasket);
    }*/
    
    for(bi=0; bi <numEx; bi++){//repeat for length of basket  
                exBlob+= 'ex'+jBasket[bi][3]+'_t'+jBasket[bi][1]+'_'+jBasket[bi][2]+'sets';
                                /*exID             exTypeID             setCount*/
                var workoutPlan = {};
                workoutPlanCreator[0]=jBasket[bi][3];/*exID*/
                workoutPlanCreator[1]=jBasket[bi][1];/*exTypeID*/               
                                
            if(jBasket[bi][1]==1){//do this when exType is resistance of current exercise
            /*(resistance)(ex1_t1(type)_6(sets)_0s_12r(reps)40lbs_1s_12r_50lbs_2s_12r_60lbs_3s_12r_70lbs_4s12r_80lb*/
                    for(setIndex=0; setIndex<jBasket[bi][2]; setIndex++){  //repeat for how many sets are stored for the exercise
    /****************************************put together names of inputs and pull info to save repCounts for repCounts    ************************/
                        var repString = jBasket[bi][0]+'set'+setIndex+'repCount';
                        var weightString = jBasket[bi][0]+'set'+setIndex+'weight';
                        exBlob+= '_'+setIndex+'set_'+document.getElementById(repString).value+'reps_'+document.getElementById(weightString).value+'lbs';
                        workoutPlanCreator[2]=setIndex;
                        workoutPlanCreator[3]=document.getElementById(repString).value;
                        workoutPlanCreator[4]=document.getElementById(weightString).value;
                    }
            }else if(jBasket[bi][1]==2){//do this when exType is timedCardio
            /*(timedCardio)ex2_t2(type)_1(sets)_0s_60sec*/
                    for(setIndex=0; setIndex<jBasket[bi][2]; setIndex++){  //repeat for how many sets are stored for the exercise
                        var durationString = jBasket[bi][0]+'set'+setIndex+'duration';
                        exBlob+= '_'+setIndex+'set_'+document.getElementById(durationString).value+'sec';
                        workoutPlanCreator[2]=setIndex;
                        workoutPlanCreator[3]=document.getElementById(durationString).value;

                    }
            }else if(jBasket[bi][1]==3){//do this when exType is mma
            /*(mma)ex2_t2(type)_1(sets)_0s_60sec_1s_45sec*/
                    for(setIndex=0; setIndex<jBasket[bi][2]; setIndex++){  //repeat for how many sets are stored for the exercise
                        var timeString = jBasket[bi][0]+'set'+setIndex+'duration';
                        exBlob+= '_'+setIndex+'set_'+document.getElementById(timeString).value+'sec';
                        workoutPlanCreator[2]=setIndex;
                        workoutPlanCreator[3]=document.document.getElementById(timeString).value;

                    }
            }else if(jBasket[bi][1]==4){//do this when exType is countedCardio
            /*(countedCardio)ex3_t3(type)_1(sets)_0s_60reps_1s_40reps*/
                    for(setIndex=0; setIndex<jBasket[bi][2]; setIndex++){  //repeat for how many sets are stored for the set count
                         var countString = jBasket[bi][0]+'set'+setIndex+'repCount';
                        exBlob+= '_'+setIndex+'set_'+document.getElementById(countString).value+'reps';
                        workoutPlanCreator[2]=setIndex;
                        workoutPlanCreator[3]=document.getElementById(countString).value;

                    }
            }

            workoutPlan += workoutPlanCreator;
    }
    
    var workoutObject = jsObject2phpObject(workoutPlan)
    
    var radios = document.getElementsByName('complete');

    for (var i = 0, length = radios.length; i < length; i++) {
        if (radios[i].checked) {
            // do whatever you want with the checked radio
            var complete = radios[i].value;
    
            // only one radio can be logically checked, don't check the rest
            break;
        }
    }
    
    if(radios[0].checked){
        
        var completeDate =  document.getElementById(completeDate).value;
    }
    
    var modes = document.getElementsByName('mode');

    for (var i = 0, length = modes.length; i < length; i++) {
        if (modes[i].checked) {
            // do whatever you want with the checked radio
            var modeID = modes[i].value;
    
            // only one radio can be logically checked, don't check the rest
            break;
        }
    }
    
    
    /** also need to send info to workoutLines table *********/
    var url ="navStoreWorkout.php";
    var vars = "workoutID="+workoutID+"&blob="+exBlob+"&completion="+complete+"&completeDate="+completeDate+"&workoutPlan="+workoutObject;
    xHRO.open("POST", url, true);
    //set content type header information for sending url encoded variables
    xHRO.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    // Access the onreadystatechange event for the XMLHttpRequest object
    xHRO.onreadystatechange = function() {
	    if(xHRO.readyState == 4 && xHRO.status == 200) {
		    var return_data = xHRO.responseText;
			document.getElementById("status").innerHTML = return_data;
	    }
    }
    //send the data to PHP and wait for the reponse to update the status div
    xHRO.send(vars);
    /*exType of each exercise, determines how exercises are added to exBlob
        Case 1:  Weighted resistance exercise
        (resistance)(ex1_t1(type)_6(sets)_1s12r(reps)40lbs_2s12r50lbs_3s1260lbs_4s1270lbs_5s1280lb
        s_6s1290lbs_
         
        (timedCardio)ex2_t2(type)_1(sets)_60sec
        (countedCardio)ex3_t3(type)_1(sets)_60reps
        exID
        ExTypeID
        sets(int)
        reps/set(12_14_15)
        weights/set(50_60_70)*/
    
}
</script>