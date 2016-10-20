
/*This file will find all exercises in the workoutBasket for the current client (using session client) and add number of sets to them */

var exBlob = "";
var numEx = <?php echo json_encode($numEx); ?>;
var jBasket= <?php echo json_encode($basket); ?>;

function buildWorkout(){
    
    /*for(var i=0; i < numEx;i++){
        //alert(jBasket[i][2]+" sets of "+jBasket[i][0])+ "s ";
        alert(jBasket);
    }*/
    
    for(bi=0; bi <numEx; bi++){//repeat for length of basket
        alert(jBasket[bi][2]+" sets of "+jBasket[bi][0])+ "s ";  
                exBlob+= 'ex'+jBasket[bi][3]+'_t'+jBasket[bi][1]+'_'+jBasket[bi][2]+'sets';
        
            if(jBasket[bi][1]==1){//do this when exType is resistance of current exercise
            alert('resistance');
            /*(resistance)(ex1_t1(type)_6(sets)_0s_12r(reps)40lbs_1s_12r_50lbs_2s_12r_60lbs_3s_12r_70lbs_4s12r_80lb*/
                    for(setCount=0; setCount<jBasket[bi][2]; setCount++){  //repeat for how many sets are stored for the set count
                        var repString = jBasket[bi][0]+'set'+setCount+'repCount';
                        alert(repString);
                        var weightString = jBasket[bi][0]+'set'+setCount+'weight';
                        alert(weightString);
                        exBlob+= '_'+setCount+'set_'+document.getElementById(repString).value+'reps_'+document.getElementById(weightString).value+'lbs';
                        alert("exBlob= "+exBlob);
                        
                    }
            }else if(jBasket[bi][1]==2){//do this when exType is timedCardio
            alert('cardio');
            /*(timedCardio)ex2_t2(type)_1(sets)_0s_60sec*/
                    for(setCount=0; setCount<jBasket[bi][2]; setCount++){  //repeat for how many sets are stored for the set count
                        var durationString = jBasket[bi][0]+'set'+setCount+'duration';
                        alert(durationString);
                        exBlob+= '_'+setCount+'set_'+document.getElementById(durationString).value+'sec';
                        alert("exBlob= "+exBlob);
                    }
            }else if(jBasket[bi][1]==3){//do this when exType is mma
            alert('mma');
            /*(mma)ex2_t2(type)_1(sets)_0s_60sec_1s_45sec*/
                    for(setCount=0; setCount<jBasket[bi][2]; setCount++){  //repeat for how many sets are stored for the set count
                        var timeString = jBasket[bi][0]+'set'+setCount+'duration';
                        alert(timeString);
                        exBlob+= '_'+setCount+'set_'+document.getElementById(timeString).value+'sec';
                        alert("exBlob= "+exBlob);
                    }
            }else if(jBasket[bi][1]==4){//do this when exType is countedCardio
            alert('cardio');
            /*(countedCardio)ex3_t3(type)_1(sets)_0s_60reps_1s_40reps*/
                    for(setCount=0; setCount<jBasket[bi][2]; setCount++){  //repeat for how many sets are stored for the set count
                         var countString = jBasket[bi][0]+'set'+setCount+'repCount';
                         alert(countString);
                        exBlob+= '_'+setCount+'set_'+document.getElementById(countString).value+'reps';
                        alert("exBlob= "+exBlob);
                    }
            }
    }
    
    alert(exBlob);
    
    
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
        weights/set(50_60_70)
    */
}
