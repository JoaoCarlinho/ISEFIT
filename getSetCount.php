<html>
    <div class="adaptSelectBox"><center>Set Count</center>
            <center>                       
                <select id="setCount" name="setCount" >
           <?php for ($x = 1; $x < 16 ; $x++){ 
                        echo('<option value="'.$x.'">'.$x.'</option>');
                 }
           ?>
                </select><br> 
            </center>        
    </div>
</html> 