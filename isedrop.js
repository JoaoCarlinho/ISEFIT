var timeout	= 3000;
var closetimer	= 0;
var dropbox	= 0;

// open hidden layer
function mopen(id)
{	
	// cancel close timer
	mcancelclosetime();

	// close old layer
	if(dropbox) dropbox.style.visibility = 'hidden';

	// get new layer and show it
	dropbox = document.getElementById(id);
	dropbox.style.visibility = 'visible';

}
// close showed layer
function mclose()
{
	if(dropbox) dropbox.style.visibility = 'hidden';
}

// go close timer
function mclosetime()
{
	closetimer = window.setTimeout(mclose, timeout);
}

// cancel close timer
function mcancelclosetime()
{
	if(closetimer)
	{
		window.clearTimeout(closetimer);
		closetimer = null;
	}
}

// close layer when click-out
/*document.onclick = mclose; */

function hide_ise(id) {
    document.getElementById(id).style.display=='none'
}

function show_ise(id) {
    document.getElementById(id).style.display='block';
}

