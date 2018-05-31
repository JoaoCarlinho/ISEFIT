    <!DOCTYPE html>
<html lang="en-us">
    <?php include('header.php'); ?>
    <body>
        <div class="container">
            <?php /********These are always on the page and used to find out what else to display*******************/
            include('appBar.php'); 
            include('navbar.php');
            
            //include('banner.php');
            ?>
 
           <?php include('workoutEditTable.php'); ?>
        </div>
    </body>
</html>

<script>

//%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%           Need to ensure no dashes are entered in the input for adjustments%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%
function editWorkout(id){
    document.getElementById(id).contentEditable = true;
}



//%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%  AJAX Functions%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%%

function loadDoc(id){
    var xmlHttp;
    var url = 'plannedWorkoutUpdater.php';
    var id = id;
    var newValue = document.getElementById(id).value;
    xmlHttp = new XMLHttpRequest();
    xmlHttp.onreadystatechange = function() {
        if(this.readyState==4  && this.status == 200){
                document.getElementById("updateNote").innerHTML = this.responseText;
                
        }
    };
    xmlHttp.open("POST", url,  true);
    xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlHttp.send("id="+id+"&newValue="+newValue);
} 



/**function updateProcess(newValue){
    if(xmlHttp.readyState==0 || xmlHttp.readyState==4){
            newValue = encodeURIComponent(document.getElementById("newValue").value);
            alert("The variable named newValue has value:  " + newValue);
            var url = "plannedWorkoutUpdater.php?newValue="+newValue;
            xmlHttp.open("POST", url,  true);
            xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xmlHttp.onreadystatechange = handleUpdateServerResponse('newValue');
            xmlHttp.send("newValue="+newValue);
        
    }else{
        setTimeout("updateProcess('newValue')",1000);
    }
}**/

/*function handleUpdateServerResponse(newValue){
    if(xmlHttp.readyState==4){ 
        if(xmlHttp.status==200){
            xmlResponse = xmlHttp.responseXML; //izvlaci se xml sto smo dobili
            xmlDocumentElement = xmlResponse.documentElement;
            message = xmlDocumentElement.firstChild.data;
            document.getElementById("updateNote").innerHTML = message;
            alert("The variable named newValue has value:  " + newValue);
            setTimeout("updateProcess('newValue')", 1000);
        }else{
            alert('Something went wrong !');
        }
    }
}
*/

</script>