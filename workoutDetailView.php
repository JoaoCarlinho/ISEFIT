    <!DOCTYPE html>
<html lang="en-us">
    <?php include('header.php'); ?>
    <body>
        <div class="container">
            <?php /********These are always on the page and used to find out what else to display*******************/
            include('appBar.php'); 
            //include('banner.php');
            ?>
 
            <div class = "main">
                <center>
              <?php if($basketCount > 0){ ?>
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
                        <div style="clear:both; width:400px;">
                            <a href="navWorkoutPlanner.php?workoutID=<?php echo $workoutID; ?>"><div class ="createWorkoutButton">Store workout</div></a>
                        </div>
             <?php }else{ ?>
                         <p>No exercises planned for workout #<?php echo $workoutID; ?></p>
                        <a href="navExSelector.php?workoutID=<?php echo $workoutID; ?>"><div class ="createWorkoutButton">Edit workout</div></a>
            <?php  }
             ?>
                    
                </center>
                
                
            </div>
            <?php   include('navbar.php');
            ?>
        </div>
    </body>
</html>

<script>

//%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%           Need to ensure no dashes are entered in the input for adjustments%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
function editWorkout(id){
    document.getElementById(id).contentEditable = true;
}



//%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%  AJAX Functions%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%

function loadDoc(id){
    var xmlHttp;
    var url = 'plannedWorkoutUpdater.php';
    var id = id;
    var newValue = document.getElementById(id).value;
    xmlHttp = new XMLHttpRequest();
    xmlHttp.onreadystatechange = function() {
        if(this.readyState==4  && this.status == 200){
                alert("The variable id has value:  " + id+" and the new value is "+ newValue);
                document.getElementById("updateNote").innerHTML = this.responseText;
                
        }
    };
    xmlHttp.open("POST", url,  true);
    xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlHttp.send("id="+id+"&newValue="+newValue);
} 



/**function updateProcess(newValue){
    if(xmlHttp.readyState==0 || xmlHttp.readyState==4){
            newValue = encodeURIComponent(document.getElementById("newValue").value);
            alert("The variable named newValue has value:  " + newValue);
            var url = "plannedWorkoutUpdater.php?newValue="+newValue;
            xmlHttp.open("POST", url,  true);
            xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xmlHttp.onreadystatechange = handleUpdateServerResponse('newValue');
            xmlHttp.send("newValue="+newValue);
        
    }else{
        setTimeout("updateProcess('newValue')",1000);
    }
}**/

/*function handleUpdateServerResponse(newValue){
    if(xmlHttp.readyState==4){ 
        if(xmlHttp.status==200){
            xmlResponse = xmlHttp.responseXML; //izvlaci se xml sto smo dobili
            xmlDocumentElement = xmlResponse.documentElement;
            message = xmlDocumentElement.firstChild.data;
            document.getElementById("updateNote").innerHTML = message;
            alert("The variable named newValue has value:  " + newValue);
            setTimeout("updateProcess('newValue')", 1000);
        }else{
            alert('Something went wrong !');
        }
    }
}
*/

</script>