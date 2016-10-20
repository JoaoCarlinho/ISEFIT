var i = 0; 
var image = new Array();

// LIST OF IMAGES 
image[0] = "images/img1.png"; 
image[1] = "images/img2.png"; 
image[2] = "images/img3.png";
image[3] = "images/img4.png";

var k = image.length - 1;

var link= new Array();   
// LIST OF LINKS 
link[0] = "camps/summer_fun.html"; 
link[1] = "camps/sum_fun_options.html"; 
link[2] = "camps/summer_fun.html";
link[3] = "/about/club_philosophy.html";

    function slide(x)
    {
        i = i + x;
        var pic = document.getElementById('imagen');
        var hyper = document.getElementById('slide_link');
        
        if (i == image.length)
            {i = 0;}
        
        if (i < 0) 
            {i = image.length-1;}
        
        pic.src= image[i];
        hyper.href = link[i];
    };

window.setInterval
(
    function auto_slide()   
        {
        var pic = document.getElementById('imagen');
        var hyper = document.getElementById('slide_link');
        
        i++;
        if (i == image.length) 
            {i = 0;}
        
        if (i < 0) 
            {i = image.length - 1;}
        
        pic.src= image[i];
        hyper.href = link[i];
        },5000
);