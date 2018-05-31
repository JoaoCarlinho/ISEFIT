var xHRO = createXmlHtpRequestObject();

function createXmlHtpRequestObject(){
    var xHRO;
    
    if(window.XMLHttpRequest){
        xHRO = new XMLHttpRequest();
    }else{
        xHRO = new ActiveXObject("Microsoft.XMLHTTP");
    }
    
    if(!xHRO){
            alert("can't add exercise");
    }else{
            return xHRO;
    }
}

function process() {
   if(xHRO){
       try{
           xHRO.open("GET", "txtParse.txt", true);
           xHRO.onreadystatechange = handleServerResponse;
           xHRO.send(null);
       }catch(e){
           alert(e.toString());
       }
   }else{
       alert('xml object cannot be created');
   }
}

function handleServerResponse(){
    var theD = document.getElementById('theD');
    if(xHRO.readyState==1){
        theD.innerHTML += "Status 1: serve connection established<br/>";
    }else if(xHRO.readyState==2){
        theD.innerHTML += "Status 2: request received<br/>";
    }else if(xHRO.readyState==3){
        theD.innerHTML += "Status 3: processing request<br/>";
    }else if(xHRO.readyState==4){
        if(xHRO.status==200){
            try{
                var text = xHRO.responseText;
                theD.innerHTML += "Status 4: request finished, response ready<br/>"
                theD.innerHTML += text;
            }catch(e){
                alert(e.toString());
            }
        }else{
            alert(xHRO.statusText);
        }
    }
}
















