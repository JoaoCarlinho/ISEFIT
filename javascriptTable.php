<html>
    <!-- http://www.java2s.com/Tutorial/JavaScript/0220__Array/OutputarrayelementinaHTMLtableformat.htm -->

    <head>
        <title>Table of Numbers</title>
    </head>

    <body>
         <center><h1>Table of Numbers</h1>

        <table border="0">
            <script language="javascript" type="text/javascript">
                <!--

                var myArray = new Array();
                

                document.write("<tr><td style='width: 100px; color: red;'>Col Head 1</td>");
                document.write("<td style='width: 100px; color: red; text-align: right;'>Col Head 2</td>");
                document.write("<td style='width: 100px; color: red; text-align: right;'>Col Head 3</td></tr>");

                document.write("<tr><td style='width: 100px;'>---------------</td>");
                document.write("<td style='width: 100px; text-align: right;'>---------------</td>");
                document.write("<td style='width: 100px; text-align: right;'>---------------</td></tr>");

                for (var i = 0; i < 8; i++) {
                    document.write("<tr><td style='width: 100px;'>Number " + i + " is:</td>");
                    myArray[i] = myArray[i].toFixed(3);
                    document.write("<td style='width: 100px; text-align: right;'>" + myArray[i] + "</td>");
                    document.write("<td style='width: 100px; text-align: right;'>" + myArray[i] + "</td></tr>");
                }

                 //-->
            </script>
        </table>
        </center>
    </body>

</html>