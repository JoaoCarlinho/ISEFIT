<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
    <head>
        <meta http-equiv="content-type" content="text/html; charset=iso-8859-2" />
        <title>Example Ajax GET</title>
         <script type="text/javascript" src="testGet.js"></script>
    </head>
    <body>
    
        <h5 style="cursor:pointer;" onclick="ajaxrequest('test_get.php', 'context')"><u>Click</u></h5>
        <div id="txt1">A string that will be sent with Ajax to the server and processed with PHP</div>
        <div id="context">Here will be displayed the response from the php script.</div>
    
    </body>
</html>