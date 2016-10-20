var i = 0; 
var image = new Array();

// LIST OF IMAGES 
image[0] = "./images/opaque_ise.png";
image[1] = "./images/training_sites.png"; 
image[2] = "./images/weight_loss.png"; 
image[3] = "./images/mass_building.png";
image[4] = "./images/meal_planning.png";
image[5] = "./images/sports_conditioning.png";

    function slide(x) 
    {
        var backdrop = document.getElementById('service_image');
        
        backdrop.src= image[x];
    };

window.setInterval
(
    function auto_slide()   
        {
        var backdrop = document.getElementById('service_image');
        
        i++;
        if (i == image.length) 
            {i = 0;}
        
        if (i < 0) 
            {i = image.length - 1;}
        
        pic.src= image[i];
        },5000
);