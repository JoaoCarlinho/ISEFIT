<html>
<head>
<script type='text/javascript'>
function addScript()
{
    var newdiv = document.createElement('div');

    var p = document.createElement('p');
    p.innerHTML = "Dynamically added text";
    newdiv.appendChild(p);

    var script = document.createElement('script');
    script.innerHTML = "alert('i am here');";
    newdiv.appendChild(script);

    document.getElementById('target').appendChild(newdiv);
}
</script>
</head>
<body>
<input type="button" value="add script" onclick="addScript()"/>
<div>hello world</div>
<div id="target"></div>
</body>
</html>