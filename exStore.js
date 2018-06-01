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
            alert("Exercise array not created");
    }else{
            return xHRO;
    }
}

function process(){
    if(xHRO.readyState==0 || xHRO.readyState==4){
        try{
            xHRO.open("GET", "exList.php?exercise=" + document.getElementById("exAdd").value, true);
            xHRO.onreadystatechange = handleServerResponse;
            xHRO.send(null);
        }catch(e){
            alert(e.toString());
        }
        
    }else{
        setTimeout('process()',1000);
<<<<<<< HEAD
        
=======
>>>>>>> 297478587b120b121a1bd94d40953e29eea03024
    }
}

function handleServerResponse(){
    if(xHRO.readyState==4){
        if(xHRO.status==200){
            var   xmlResponse = xHRO.responseXML;
            var   xmlDocumentElement = xmlResponse.documentElement;
            var   message = xmlDocumentElement.firstChild.data;
            document.getElementById("exNote").innerHTML = message;
            setTimeout('process()',1000);        
        }else{
            alert(xHRO.statusText);
        }
    }
}

