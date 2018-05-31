<!DOCTYPE html>
<html>
<center><div>
                            <h3>the ISE maker</h3>
                <form action="navExSelector.php" method="post">
                    <!-- **********************Date selector for date of planned execution of workout******************************------------->
                    <p>Select a date for completion of your workout</p>
                    <input type="date" name="datePlanned" id="datePlanned"/>
                    <!--******************************************autoComplete for adaptations**********************************----------------------------------------->
                    <p>Select the fitness goal for the workout</p>
                    <?php include('adaptSelector.php'); ?>
        
        <!--******************************************autoComplete for focus area*******************-------------------------------------------------->
                    <p>Select an area of focus for the workout</p>
                    <?php include('focusSelector.php'); ?>
                    <br/><br/>
                    
            <!-- the button below will use onClick="queueEx(); with ajax for single page funcitonality-->
                    <input style="display:inline;" class ="createWorkoutButton" type="submit" value="create workout!"/>
                </form>
            <p id="queueStatus"></p>
        </div></center>
</html> 