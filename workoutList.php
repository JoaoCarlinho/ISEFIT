<!--  associate index of each exercise in basket with exTypeID and create inputs for rep/time and weights for each   

First step is to find the length of $basket

The number of rows in the table will be = count($basket)
once inside of each row, pull out exName, exTypeID, and set number inside of each row
-->
<center>
    <table cellpadding="2" cellspacing="2" border="1">
            <tr>
<<<<<<< HEAD
                <?php for($bi=0; $bi<count($basket); $bi++){ ?>
=======
        
                <?php for($bi=0; $bi<count($basket); $bi++){ /*********************$bi represents how many exercises are in basket*******/?>
>>>>>>> 297478587b120b121a1bd94d40953e29eea03024
                    <tr>
                        <td>Delete</td>
                        <td><?php echo ($bi + 1); ?></td><!-- row number -->
                        <td><?php echo $basket[$bi][0]; ?></td><!-- exName -->
                        <td><?php /** input fields based on exTypeID (columns) and number of sets(rows)**/
                            if( $basket[$bi][1] == 1){     ?>
<!----------------------------if exTypeID is 1(create an columns for weight and reps for each set(row)---------------------------------------->
                               
                               <table cellpadding="2" cellspacing="2" border="1">
                                   <tr><th>weight</th><th>reps</th></tr>
                                   <?php for($setCount=0; $setCount<$basket[$bi][2]; $setCount++){ ?>
                                               <?php   $weightInput = $basket[$bi][0].'set'.$setCount.'weight';
                                                       $repCountInput = $basket[$bi][0].'set'.$setCount.'repCount';?>
                                       <tr><td><input type="text" id="<?php echo $weightInput;?>" value="weight"></td><td><input type="text" id="<?php echo $repCountInput;?>"  value="reps"></td></tr>
                                                               
                         <!--                         Finding out the names of the input boxes                                          -->                                      
                                                        <?php/**   echo '<script language="javascript">';
                                                                echo 'alert("'.$repCountInput.'"+" for rep input "+"'.$weightInput.'"+" for weight input" )';
                                                                echo '</script>';**/
                                                        ?>
                                   <?php } ?>
                                   
                               </table>
                    <?php   }else if( $basket[$bi][1] == 2){     ?>
<!-----------------------------if exTypeID is 2(create one column for duration of each set(row)----------------------------------------------->
                               
                               <table cellpadding="2" cellspacing="2" border="1">
                                   <tr><th>time</th></tr>
                                   <?php for($setCount=0; $setCount<$basket[$bi][2]; $setCount++){ ?>
                                               <?php $timeInput= $basket[$bi][0].'set'.$setCount.'duration';?>
                                       <tr><td><input type="text" id="<?php echo $timeInput;?>" value="seconds"></td></tr>
                         <!--                         Finding out the names of the input boxes                                          -->                                      
                                                        <?php/**   echo '<script language="javascript">';
                                                                echo 'alert("'.$timeInput.'"+" for time input" )';
                                                                echo '</script>';**/
                                                        ?>          
                                   <?php } ?>
                               </table> 
                    <?php   }else if( $basket[$bi][1] == 3){    ?>
<!-------------------------------if exTypeID is 3(create one column for duration of each set(row)---------------------------------------------->
                               
                               <table cellpadding="2" cellspacing="2" border="1">
                                   <tr><th>duration</th></tr>
                                   <?php for($setCount=0; $setCount<$basket[$bi][2]; $setCount++){ ?>
                                                   <?php $timeInput= $basket[$bi][0].'set'.$setCount.'duration';?>
                                       <tr><td><input type="text" id="<?php echo $timeInput;?>" value="seconds"></td></tr>
                         <!--                         Finding out the names of the input boxes                                          -->                                      
                                                        <?php/**   echo '<script language="javascript">';
                                                                echo 'alert("'.$timeInput.'"+" for time input" )';
                                                                echo '</script>';**/
                                                        ?>           
                                   
                                   <?php } ?>
                                   
                               </table> 
                    <?php   }else if( $basket[$bi][1] == 4){    ?>
<!-------------------------------if exTypeID is 4(create one column for count of each set(row)------------------------------------------------->
                               
                               <table cellpadding="2" cellspacing="2" border="1">
                                   <tr><th>count</th></tr>
                                   <?php for($setCount=0; $setCount<$basket[$bi][2]; $setCount++){ ?>
                                                   <?php $repCountInput = $basket[$bi][0].'set'.$setCount.'repCount';?>
                                       <tr><td><input type="text" id="<?php echo $repCountInput;?>" value="reps"></td></tr>
                         <!--                         Finding out the names of the input boxes                                          -->                                      
                                                        <?php/**   echo '<script language="javascript">';
                                                                echo 'alert("'.$repCountInput.'"+" for rep input" )';
                                                                echo '</script>';**/
                                                        ?>           
                                   
                                   <?php } ?>
                                   
                               </table>
                    <?php   } ?>   
                        </td>
<<<<<<< HEAD
<!---------------------------------- end sets and reps entry -------------------------------------------------------------------------------->
=======
<!---------------------------------- adaptation entry -------------------------------------------------------------------------------->
                        <td>
                            <input type="text" id="<?php echo $adaptationInput.$basket[$bi;?>" value="reps">
                        </td>
                        
                        
>>>>>>> 297478587b120b121a1bd94d40953e29eea03024
                    </tr>
                <?php }
                        $numEx = count($basket);
                ?>
            </tr>
    </table><br>
    
    <div><?php include('adaptSelector.php'); ?></div><br>
    <div><?php include('focusSelector.php'); ?></div><br>
    
    <input type="radio" name="complete" value="1" checked> I completed this workout<br>
    <input type="radio" name="complete" value="0">This is a future workout<br>
    
    <div id="date">
        <label for="bday">Completion date</label>
        <input type="date" name="date" id="completeDate">
    </div><br/>
        
    <a href="clientWorkouts.php"><input type="submit" value="Create Workout!" onclick="javascript: buildWorkout()"/></a>
    <p id="status"></p>
</center>
<!-- the create workout button should build the exBlob using the values in basket 
combined with the values in the inputs for each exercise  -->


<script type="text/javascript">
/*******************************fuction to include date selector if user indicates they've completed the current workout**************/
function checkCompletion(){
    var radios = document.getElementsByName('complete');

        if(radios[1].checked) {
            // hide selector is second radio box checked
            document.getElementById(date).style.display = 'none';
        }else if(radio[0].checked){
            document.getElementById(date).style.display = 'block';
        }
    
    setTimeout(checkCompletion(), 4000);
}


/****************Find all exercises in the workoutBasket for the current client (using session client) and add number of sets to them */
    var exBlob = "";
    var numEx = <?php echo json_encode($numEx); ?>;
    var jBasket= <?php echo json_encode($basket); ?>;
    
    var xHRO = createXmlHttpRequestObject();

function buildWorkout(){
    
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

    /*for(var i=0; i < numEx;i++){
        //alert(jBasket[i][2]+" sets of "+jBasket[i][0])+ "s ";
        alert(jBasket);
    }*/
    
    for(bi=0; bi <numEx; bi++){//repeat for length of basket  
                exBlob+= 'ex'+jBasket[bi][3]+'_t'+jBasket[bi][1]+'_'+jBasket[bi][2]+'sets';
        
            if(jBasket[bi][1]==1){//do this when exType is resistance of current exercise
            /*(resistance)(ex1_t1(type)_6(sets)_0s_12r(reps)40lbs_1s_12r_50lbs_2s_12r_60lbs_3s_12r_70lbs_4s12r_80lb*/
                    for(setCount=0; setCount<jBasket[bi][2]; setCount++){  //repeat for how many sets are stored for the set count
<<<<<<< HEAD
=======
    /****************************************put together names of inputs and pull info to save repCounts for repCounts    ************************/
>>>>>>> 297478587b120b121a1bd94d40953e29eea03024
                        var repString = jBasket[bi][0]+'set'+setCount+'repCount';
                        var weightString = jBasket[bi][0]+'set'+setCount+'weight';
                        exBlob+= '_'+setCount+'set_'+document.getElementById(repString).value+'reps_'+document.getElementById(weightString).value+'lbs';
                    }
            }else if(jBasket[bi][1]==2){//do this when exType is timedCardio
            /*(timedCardio)ex2_t2(type)_1(sets)_0s_60sec*/
                    for(setCount=0; setCount<jBasket[bi][2]; setCount++){  //repeat for how many sets are stored for the set count
                        var durationString = jBasket[bi][0]+'set'+setCount+'duration';
                        exBlob+= '_'+setCount+'set_'+document.getElementById(durationString).value+'sec';
                    }
            }else if(jBasket[bi][1]==3){//do this when exType is mma
            /*(mma)ex2_t2(type)_1(sets)_0s_60sec_1s_45sec*/
                    for(setCount=0; setCount<jBasket[bi][2]; setCount++){  //repeat for how many sets are stored for the set count
                        var timeString = jBasket[bi][0]+'set'+setCount+'duration';
                        exBlob+= '_'+setCount+'set_'+document.getElementById(timeString).value+'sec';
                    }
            }else if(jBasket[bi][1]==4){//do this when exType is countedCardio
            /*(countedCardio)ex3_t3(type)_1(sets)_0s_60reps_1s_40reps*/
                    for(setCount=0; setCount<jBasket[bi][2]; setCount++){  //repeat for how many sets are stored for the set count
                         var countString = jBasket[bi][0]+'set'+setCount+'repCount';
                        exBlob+= '_'+setCount+'set_'+document.getElementById(countString).value+'reps';
                    }
            }
    }
    
    var aS = document.getElementById("adaptSelector");
    var adapt = aS.options[aS.selectedIndex].value;
    
    var fS = document.getElementById("focusSelector");
    var focus = fS.options[fS.selectedIndex].value;
    
    var radios = document.getElementsByName('complete');

    for (var i = 0, length = radios.length; i < length; i++) {
        if (radios[i].checked) {
            // do whatever you want with the checked radio
            var complete = radios[i].value;
    
            // only one radio can be logically checked, don't check the rest
            break;
        }
    }
    
    if(radio[0].checked){
        
        var completeDate =  document.getElementById(completeDate).value;
    }
    
    /** also need to send info to workoutLines table *********/
    var url ="storeWorkout.php";
<<<<<<< HEAD
    var vars = "blob="+exBlob+"&adaptation="+adapt+"&focus="+focus+"&completion="+complete="&completeDate="+completeDate;;
=======
    var vars = "blob="+exBlob+"&adaptation="+adapt+"&focus="+focus+"&completion="+complete="&completeDate="+completeDate"&jBasket="+jBasket;
>>>>>>> 297478587b120b121a1bd94d40953e29eea03024
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