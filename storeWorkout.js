/****This file sends a signal to storeWorkout.php to store the logged in clients exercises from workoutBasket in the workouts table*****/

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
            alert("Exercise not stored");
    }else{
            return xHRO;
    }
}

<<<<<<< HEAD
function storeWorkout(){
    if(xHRO.readyState==0 || xHRO.readyState==4){
        try{
            xHRO.open("GET", "storeWorkout.php?confirm=1", true);
=======
function queueEx(){
    if(xHRO.readyState==0 || xHRO.readyState==4){
        try{
            xHRO.open("GET", "queueEx.php?confirm=1", true);
>>>>>>> 297478587b120b121a1bd94d40953e29eea03024
            xHRO.onreadystatechange = handleServerResponseS;
            xHRO.send(null);
        }catch(e){
            alert(e.toString());
        }
        
    }
}

function handleServerResponseS(){
    if(xHRO.readyState==4){
        if(xHRO.status==200){
            var   xmlResponse = xHRO.responseXML;
            var   xmlDocumentElement = xmlResponse.documentElement;
            var   message = xmlDocumentElement.firstChild.data;
<<<<<<< HEAD
            document.getElementById("workoutStatus").innerHTML = message;        
=======
            document.getElementById("queueStatus").innerHTML = message;        
>>>>>>> 297478587b120b121a1bd94d40953e29eea03024
        }else{
            alert(xHRO.statusText);
        }
    }
}
