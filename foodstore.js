var xmlHttp = createXmlHttpRequestObject();

function createXmlHttpRequestObject(){
var xmlHttp;

if(window.ActiveXObject){ 
    try{
        xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
    }catch(e){
        xmlHttp = false;
    }
}else{ 
    try{
        xmlHttp = new XMLHttpRequest();
    }catch(e){
        xmlHttp = false;
    }
}

if(!xmlHttp)
    alert("Cant create that object !")
else
    return xmlHttp;
}

function process(){
if(xmlHttp.readyState==0 || xmlHttp.readyState==4){
    food = encodeURIComponent(document.getElementById("userInput").value);
    xmlHttp.open("GET", "foodstore.php?food="+food,true);
    xmlHttp.onreadystatechange = handleServerResponse;
    xmlHttp.send(null);
}else{
    setTimeout('process()',1000);//cekaj 1s pa probaj opet
}
}

function handleServerResponse(){
if(xmlHttp.readyState==4){ 
    if(xmlHttp.status==200){
        xmlResponse = xmlHttp.responseXML; //izvlaci se xml sto smo dobili
        xmlDocumentElement = xmlResponse.documentElement;
        message = xmlDocumentElement.firstChild.data;
        document.getElementById("underInput").innerHTML = message;
        setTimeout('process()', 1000);
    }else{
        alert('Someting went wrong !');
    }
}
}
