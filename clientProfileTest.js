// create the XMLHttpRequest object, according browser
function get_XmlHttp() {
  // create the variable that will contain the instance of the XMLHttpRequest object (initially with null value)
  var xmlHttp = null;

  if(window.XMLHttpRequest) {		// for Forefox, IE7+, Opera, Safari, ...
    xmlHttp = new XMLHttpRequest();
  }
  else if(window.ActiveXObject) {	// for Internet Explorer 5 or 6
    xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
  }

  return xmlHttp;
}

var request =  get_XmlHttp();


// sends data to a php file, via GET, and displays the received answer
function handleServerResponse() {
  		// call the function for the XMLHttpRequest instance

  // create the URL with data that will be sent to the server (a pair index=value)
  var  url = 'exList.php?exercise=' + document.getElementById("exAdd").value;

  request.open("GET", url, true);			// define the request
  request.send(null);		// sends data

  // Check request status
  // If the response is received completely, will be transferred to the HTML tag with tagID
  request.onreadystatechange = function() {
    if (request.readyState == 4) {
      document.getElementById(context).innerHTML = request.responseText;
    }
  }
}

function process(){
    
    if(request.readyState==0 || request.readyState==4){
        try{
            var exercise = encodeURIComponent(document.getElementById("exAdd").value);
            request.open("GET", "exList.php?exercise=" + document.getElementById("exAdd").value, true);
            request.onreadystatechange = handleServerResponse;
            request.send(null);
        }catch(e){
            alert(e.toString());
        }
        
    }else{
        setTimeout('process()',1000);
        
    }
}
