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

function autoLoad(){
    var url ="echoBasket.php";
    var vars ="";
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

function queueEx(){
    document.getElementById("queueStatus").innerHTML = 'attempting insertion';
    var url ="echoBasket.php";
    var newEx = document.getElementById("srch").value;
    var setCount = document.getElementById("exCount").value;
    var vars = "newEx="+newEx+"&setCount="+setCount;
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

function deleteRow(x,y){
    document.getElementById("queueStatus").innerHTML = 'attempting insertion';
    var url ="echoBasket.php";
    var index = x;
    var newEx = y;
    var vars = "newEx="+newEx+"&index="+index;
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
