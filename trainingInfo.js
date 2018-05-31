/************************************************navBar functions******************************/

function normal(){
    var box = document.getElementById("box");
    box.className = "logo_center" 
}

function blank(){
    var box = document.getElementById("box");
    box.className = "blank" 
    
}

function optimizePic(){
    var box = document.getElementById("box");
    var newHtml = ''
    box.innerHTML = newHtml;
    box.className = "optimize_pic"
}

function successPic(){
    var box = document.getElementById("box");
    var newHtml = ''
    box.innerHTML = newHtml;
    box.className = "success_pic"
}

function specialPic(){
    var box = document.getElementById("box");
    var newHtml = ''
    box.innerHTML = newHtml;
    box.className = "specialization_pic"
}

function programPic(){
    var box = document.getElementById("box");
    var newHtml = ''
    box.innerHTML = newHtml;
    box.className = "program_pic"
}

/*******************************************************************description functions**************************************/
function description(){/* show optimizer.php in box */
    var box = document.getElementById("box");
    box.className = "blank";
    var newHtml ='<div id="buttonList"><div onMouseOver="jTag()" class="juan_link" style="background-image:url(jtag.png); height:80px; width:160px; border-radius:30px;"></div><div onMouseOver="jDiploma()" class="juan_link" style="background-image:url(diploma.png); width:50px; height:80px;"></div><div onMouseOver="jLightning()" class="juan_link" style="background-image:url(lightning.jpg); width:83px; height:80px; border-radius:30px;"></div><div onMouseOver="jHistory()" class="juan_link" style="background-image:url(history.png); width:105px; height:80px;  border-radius:15px; "></div></div><div id="juanResponse" height:160px; width:400px; margin:0 auto 0 auto;"></div>'
    box.innerHTML = newHtml;
    
}

function jTag(){
    var miniBox = document.getElementById("juanResponse");
    miniBox.className = "nameTagPic";
}

function jDiploma(){
    var miniBox = document.getElementById("juanResponse");
    miniBox.className = "diplomaPic"
}

function jLightning(){
    var miniBox = document.getElementById("juanResponse");
    miniBox.className = "lightningPic"
}

function jHistory(){
    var miniBox = document.getElementById("juanResponse");
    miniBox.className = "historyPic"
}




/*****************************************************************location functions**************************************/

function location(){/* show locations.php in box */
    
}


/*****************************************************************philosophy functions**************************************/


function philosophy(){/* show philosophy.php in box */
    
}

/*****************************************************************success functions**************************************/


function successList(){/* show success.php in box */
    
}


/*****************************************************************specialization functions**************************************/

function specialization(){/* show specialization.php in box */
    
}

/*****************************************************************program functions**************************************/


function program(){/* show programs.php in box */
    
}




/*****************************************************************contact functions**************************************/


function contact(){/* show contact.php in box */
    
}