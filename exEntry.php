<!DOCTYPE HTML>
<html>    
    <div>
        <center><font color="<?php echo($color); ?>"><?php echo($message); ?></font></center>
    </div>
        <center>Exercise Creation Box</center><br>
            <center><form action="exCreation.php" method="post">
                <input class = "textbox" type="text" name="name" placeholder="Exercise Name" autocomplete="off" required/><br/> 
                <p>Select area of focus</p>
                <select id="focusArea" name="focusID">
                    <option value="1">Full Body</option>
                    <option value="2">Core</option>
                    <option value="3">Upper Body</option>
                    <option value="4">Lower Body</option>
                </select>
                <p>Select type of exercise</p>
                <select id="exerciseTypeID" name="exerciseTypeID">
                    <option value="1">resistance</option>
                    <option value="2">cardio</option>
                    <option value="3">mma</option>
                </select>
                <p>pushing or pulling exercise?</p>                       
                <select id="pushOrPull" name="pushOrPull">
                    <option value="1">Pushing</option>
                    <option value="2">Pulling</option>
                </select>
                <p>Is this an isolation exercise?</p>
                <select id="isolation" name="isolation">
                    <option value="1">Yes</option>
                    <option value="2">No</option>
                </select><br/><br/>
                <input type="submit" name="Submit" />
            </form></center><br/>
    <center><div>
        <a href="isefitclub.com"><button  type="button ">Home</button></a>
    </div></center>
</html>