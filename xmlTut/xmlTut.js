var xHRO = createXmlHttpRequestObject();

function createXmlHttpRequestObject(){
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
           xHRO.open("GET", "xmlTut.xml", true);
           xHRO.onreadystatechange = handleStateChange;
           xHRO.send(null);
       }catch(e){
           alert(e.toString());
       }
   }else{
       alert('xml object cannot be created');
   }
}

function handleStateChange(){
    if(xHRO.readyState==4){
        if(xHRO.status==200){
            try{
                handleResponse();
            }catch(e){
                alert(e.toString());
            }
        }else{
            alert(xHRO.statusText);
        }
    }
}

function handleResponse(){
    var xmlResponse = xHRO.responseXML;
    var root = xmlResponse.documentElement;
    var names = root.getElementsByTagName("name");
    var ssns = root.getElementsByTagName("ssn");
    
    var stuff = "";
    for(var i=0; i<names.length; i++){
        stuff += names.item(i).firstChild.data + " - " + ssns.item(i).firstChild.data + "<br/>";    
    }
    
    var theD = document.getElementById("theD");
    theD.innerHTML = stuff;
}
















