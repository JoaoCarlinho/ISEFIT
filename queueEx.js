/****This file should take the exercise name from exAdd input and send it to queueEx.php to verify existence of exercise.
     Once exercise is validated, store in workoutBasket*****/

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

function queueEx(){
    document.getElementById("queueStatus").innerHTML = 'attempting insertion';
    var url ="queueEx.php";
    var exercise = document.getElementById("srch").value;
    var setCount = document.getElementById("exCount").value;
    var adaptation = document.getElementById("adaptation").value;
    var vars = "exercise="+exercise+"&setCount="+setCount+"&adaptation="+adaptation;
    if(xHRO.readyState==0 || xHRO.readyState==4){
        try{
            
            xHRO.open("POST",url, true);
            xHRO.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xHRO.onreadystatechange = handleServerResponseQ;
            xHRO.send(vars);
        }catch(e){
            alert(e.toString());
        }
        
    }
}

function storeEx(){
    document.getElementById("queueStatus").innerHTML = 'attempting insertion';
    var url ="queueEx.php";
    var store = 1;
    var exercise = document.getElementById("srch").value;
    var setCount = document.getElementById("exCount").value;
    var vars = "exercise="+exercise+"&setCount="+setCount;
    if(xHRO.readyState==0 || xHRO.readyState==4){
        try{
            
            xHRO.open("POST",url, true);
            xHRO.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xHRO.onreadystatechange = handleServerResponseQ;
            xHRO.send(vars);
        }catch(e){
            alert(e.toString());
        }
        
    }
}

function handleServerResponseQ(){
    if(xHRO.readyState==4){
        if(xHRO.status==200){
            var   xmlResponse = xHRO.responseText;
            document.getElementById("queueStatus").innerHTML = xmlResponse;        
        }else{
            alert(xHRO.statusText);
        }
    }
}
