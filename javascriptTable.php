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
<<<<<<< HEAD
                myArray[0] = 1;
                myArray[1] = 2.218;
                myArray[2] = 33;
                myArray[3] = 114.94;
                myArray[4] = 5;
                myArray[5] = 33;
                myArray[6] = 114.980;
                myArray[7] = 5;
=======
                
>>>>>>> 297478587b120b121a1bd94d40953e29eea03024

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