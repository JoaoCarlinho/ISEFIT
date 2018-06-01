<?php  /****   groupCreation.php *****************************************************************************************/
//If all these are set, enter them into the database and go to newGroup.php

if(isset($_GET['message'])){
    $message = $_GET['message'];
    $color = 'red';
}else{
    $message = 'Parent Registration';
    $color = 'black';
} ?>

<!DOCTYPE HTML>
<html>
<!--*******************************************gc.php(registration index)***********************************************************-->
    <?php include 'header.php';?>

    <body>
    
        <div class="page">
            <?php include'appBar.php';?>
            <div id="exhibitor">
                <div class="formBox">
                 <br/>
                           <center><font color="<?php echo($color); ?>"><?php echo($message); ?></font></center>                            
                </div>
                <center><form action="#" method="post">                       
                    <input  type="number" name="groupCount" placeholder="Number of Students" autocomplete="off" required/>
                    <input  type="text" name="contactFirstName" placeholder="First name" autocomplete="off" required/> 
                    <input  type="text" name="contactLastName" placeholder="Last name" autocomplete="off" required/> 
                    <input  type="email" name="contactEmail" placeholder="Email" autocomplete="off" required/>
                    <p>10 digit number without dashes(xxxxxxxxxx)</p>
                    <input  type="number" size"10" name="contactMobile" placeholder="Contact Mobile Phone" required/>  
                    <p>Type of School</p>
                    <div class="styledSelect">
                        <select id="affiliateType" name="affiliateType">
                            <option value="Middle School">Middle School</option>
                            <option value="High School">High School</option>
                            <option value="Other">Other</option>
                        </select>
                    </div><br/>
                    <input  type="text" name="affiliateName" placeholder="School Name" autocomplete="off"/>
                    <input  type="text" name="affiliateCity" placeholder="Home City" autocomplete="off"/>
                    <p>Home State</p>
                    <div class="styledSelect">
                        <select id="affiliateState" name="affiliateState">
                        <option value="AL">Alabama</option>
                        	<option value="AK">Alaska</option>
                        	<option value="AZ">Arizona</option>
                        	<option value="AR">Arkansas</option>
                        	<option value="CA">California</option>
                        	<option value="CO">Colorado</option>
                        	<option value="CT">Connecticut</option>
                        	<option value="DE">Delaware</option>
                        	<option value="DC">District Of Columbia</option>
                        	<option value="FL">Florida</option>
                        	<option value="GA">Georgia</option>
                        	<option value="HI">Hawaii</option>
                        	<option value="ID">Idaho</option>
                        	<option value="IL">Illinois</option>
                        	<option value="IN">Indiana</option>
                        	<option value="IA">Iowa</option>
                        	<option value="KS">Kansas</option>
                        	<option value="KY">Kentucky</option>
                        	<option value="LA">Louisiana</option>
                        	<option value="ME">Maine</option>
                        	<option value="MD">Maryland</option>
                        	<option value="MA">Massachusetts</option>
                        	<option value="MI">Michigan</option>
                        	<option value="MN">Minnesota</option>
                        	<option value="MS">Mississippi</option>
                        	<option value="MO">Missouri</option>
                        	<option value="MT">Montana</option>
                        	<option value="NE">Nebraska</option>
                        	<option value="NV">Nevada</option>
                        	<option value="NH">New Hampshire</option>
                        	<option value="NJ">New Jersey</option>
                        	<option value="NM">New Mexico</option>
                        	<option value="NY">New York</option>
                        	<option value="NC">North Carolina</option>
                        	<option value="ND">North Dakota</option>
                        	<option value="OH">Ohio</option>
                        	<option value="OK">Oklahoma</option>
                        	<option value="OR">Oregon</option>
                        	<option value="PA">Pennsylvania</option>
                        	<option value="RI">Rhode Island</option>
                        	<option value="SC">South Carolina</option>
                        	<option value="SD">South Dakota</option>
                        	<option value="TN">Tennessee</option>
                        	<option value="TX">Texas</option>
                        	<option value="UT">Utah</option>
                        	<option value="VT">Vermont</option>
                        	<option value="VA">Virginia</option>
                        	<option value="WA">Washington</option>
                        	<option value="WV">West Virginia</option>
                        	<option value="WI">Wisconsin</option>
                        	<option value="WY">Wyoming</option>
                        </select>
                    </div><br/><br/>
                    <input type="submit" value="Submit" />
                </form></center>
                <br/>
                <br/>
                <?php include '../footer.php'; ?>
            </div>
        </div>
    </body>
</html>