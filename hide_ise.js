var lightSwitch = 0
var clapOff = 0

function show_ise(id) {
    if(lightSwitch) lightSwitch.style.display=='none'
    
    lightSwitch = document.getElementById(id);
	lightSwitch.style.display = 'block';
}

function hide_ise(id) {
    if(clapOff) clapOff.style.display=='block'
    
    clapOff = document.getElementById(id);
	clapOff.style.display = 'none';
}
