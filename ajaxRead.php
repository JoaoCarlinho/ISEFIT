<!DOCTYPE html>
<html>
    <head>
        <title>Ajax dbQuery</title
    </head>
    <body>
        <input type="text" id="name"/>
        <input type="submit" id="name-submit" value="Grab"/>
        <div id="show"/>
        
        <script src="http://code.jquery.com/jquery-1.8.0.min.js"></script>
        <script src="jquery.js"></script>
        <script type="text/javascript">
           /* $(document).ready(function() {
                setInterval(function(){
                    $('#show').load('data.php')
                }, 500);
            }) */
            
            $('input#name-submit').on('click', function() {
                var name = $('input#name').val();
                if($.trim(name) != ''){
                   $.post('name.php', {name: name}, function(data) {
                      $('div#show').load('data.php');
                   }); 
                }
            });
        </script>
    </body>
</html>