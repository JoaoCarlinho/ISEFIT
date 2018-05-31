function gametime(){
    var title = document.createTextNode("Here are some things!");
    var list = document.createElement("ul");
    
    var item1 = document.createElement("li");
    var text1 = document.createTextNode("First Text Element");
    item1.appendChild(text1);
    
    var item2 = document.createElement("li");
    var text2 = document.createTextNode("Second Text Element");
    item2.appendChild(text2);
    
    var item3 = document.createElement("li");
    var text3 = document.createTextNode("Third Text Element");
    item3.appendChild(text3);
    
    list.appendChild(item1);
    list.appendChild(item2);
    list.appendChild(item3);
    
    var theD = document.getElementById("theD");
    theD.appendChild(title);
    theD.appendChild(list);
}