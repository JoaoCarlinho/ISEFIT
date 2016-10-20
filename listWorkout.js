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

function storeWorkout(){
    if(xHRO.readyState==0 || xHRO.readyState==4){
        try{
            xHRO.open("GET", "storeWorkout.php?confirm=1", true);
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
            document.getElementById("workoutStatus").innerHTML = message;        
        }else{
            alert(xHRO.statusText);
        }
    }
}
