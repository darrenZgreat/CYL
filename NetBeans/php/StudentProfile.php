<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js" type="text/javascript"></script>
        <script src="../js/facebook.js"></script>
        
        <script src="../js/StudentProfileScripts.js"></script>
        <link href="../css/StudentProfileStyles.css" rel="stylesheet">
        
        <title>Student Profile</title>
    </head>
    <body>
        <?php
            include '../header.html';
            include 'DatabaseStudentProfile.php';
            $student = getStudent(1);
        ?>
        <div class="left-buffer"></div>
        <main>
            <form enctype="multipart/form-data" action="UpdateStudentProfile.php" method="post" onsubmit="return validate()">
            <div class="tall">
                <div class="col-1-2-top">
                    <fieldset class="tall">
                    <figure>
                        <img class="picture" src="../uploads/ProfilePic - <?php echo $student->firstname.$student->lastname ?>.jpg" alt="Profile Picture">
                    </figure>
                        <input class="file file-picture" type="file" name="picture" accept="image/jpeg"><br>
                </fieldset>
                </div><div class="col-2-2-top">
                <fieldset class="tall">
                    <input class="input-left first" type="text" name="firstname" readonly value="<?php echo $student->firstname; ?>">
                    <input class="input-left" type="text" name="lastname" readonly value="<?php echo $student->lastname; ?>">
                    <br><small></small><br>
                    <p>Member since:</p><input type="text" name="since" readonly value="<?php echo $student->since; ?>" size="10">
                    <br><small></small><br>
                    <input class="input-left" id="street" type="text" name="street" value="<?php echo $student->street; ?>"><br>
                    <small class="errorMessage" id="streeterror">Street Address: required; e.g. 822 Street Way</small><br>
                    <input class="input-left" id="city" type="text" name="city" value="<?php echo $student->city; ?>">,
                    <!--<input id="state" type="text" name="state" value="CO">-->
                    <select id="state" name="state">
                        <option value="AL" <?php if($student->state==="AL"){echo "selected";} ?>>Alabama</option>
                        <option value="AK" <?php if($student->state==="AK"){echo "selected";} ?>>Alaska</option>
                        <option value="AZ" <?php if($student->state==="AZ"){echo "selected";} ?>>Arizona</option>
                        <option value="AR" <?php if($student->state==="AR"){echo "selected";} ?>>Arkansas</option>
                        <option value="CA" <?php if($student->state==="CA"){echo "selected";} ?>>California</option>
                        <option value="CO" <?php if($student->state==="CO"){echo "selected";} ?>>Colorado</option>
                        <option value="CT" <?php if($student->state==="CT"){echo "selected";} ?>>Connecticut</option>
                        <option value="DE" <?php if($student->state==="DE"){echo "selected";} ?>>Delaware</option>
                        <option value="DC" <?php if($student->state==="DC"){echo "selected";} ?>>District of Columbia</option>
                        <option value="FL" <?php if($student->state==="FL"){echo "selected";} ?>>Florida</option>
                        <option value="GA" <?php if($student->state==="GA"){echo "selected";} ?>>Georgia</option>
                        <option value="HI" <?php if($student->state==="HI"){echo "selected";} ?>>Hawaii</option>
                        <option value="ID" <?php if($student->state==="ID"){echo "selected";} ?>>Idaho</option>
                        <option value="IL" <?php if($student->state==="IL"){echo "selected";} ?>>Illinois</option>
                        <option value="IN" <?php if($student->state==="IN"){echo "selected";} ?>>Indiana</option>
                        <option value="IA" <?php if($student->state==="IA"){echo "selected";} ?>>Iowa</option>
                        <option value="KS" <?php if($student->state==="KS"){echo "selected";} ?>>Kansas</option>
                        <option value="KY" <?php if($student->state==="KY"){echo "selected";} ?>>Kentucky</option>
                        <option value="LA" <?php if($student->state==="LA"){echo "selected";} ?>>Louisiana</option>
                        <option value="ME" <?php if($student->state==="ME"){echo "selected";} ?>>Maine</option>
                        <option value="MD" <?php if($student->state==="MD"){echo "selected";} ?>>Maryland</option>
                        <option value="MA" <?php if($student->state==="MA"){echo "selected";} ?>>Massachusetts</option>
                        <option value="MI" <?php if($student->state==="MI"){echo "selected";} ?>>Michigan</option>
                        <option value="MN" <?php if($student->state==="MN"){echo "selected";} ?>>Minnesota</option>
                        <option value="MS" <?php if($student->state==="MS"){echo "selected";} ?>>Mississippi</option>
                        <option value="MO" <?php if($student->state==="MO"){echo "selected";} ?>>Missouri</option>
                        <option value="MT" <?php if($student->state==="MT"){echo "selected";} ?>>Montana</option>
                        <option value="NE" <?php if($student->state==="NE"){echo "selected";} ?>>Nebraska</option>
                        <option value="NV" <?php if($student->state==="NV"){echo "selected";} ?>>Nevada</option>
                        <option value="NH" <?php if($student->state==="NH"){echo "selected";} ?>>New Hampshire</option>
                        <option value="NJ" <?php if($student->state==="NJ"){echo "selected";} ?>>New Jersey</option>
                        <option value="NM" <?php if($student->state==="NM"){echo "selected";} ?>>New Mexico</option>
                        <option value="NY" <?php if($student->state==="NY"){echo "selected";} ?>>New York</option>
                        <option value="NC" <?php if($student->state==="NC"){echo "selected";} ?>>North Carolina</option>
                        <option value="ND" <?php if($student->state==="ND"){echo "selected";} ?>>North Dakota</option>
                        <option value="OH" <?php if($student->state==="OH"){echo "selected";} ?>>Ohio</option>
                        <option value="OK" <?php if($student->state==="OK"){echo "selected";} ?>>Oklahoma</option>
                        <option value="OR" <?php if($student->state==="OR"){echo "selected";} ?>>Oregon</option>
                        <option value="PA" <?php if($student->state==="PA"){echo "selected";} ?>>Pennsylvania</option>
                        <option value="RI" <?php if($student->state==="RI"){echo "selected";} ?>>Rhode Island</option>
                        <option value="SC" <?php if($student->state==="SC"){echo "selected";} ?>>South Carolina</option>
                        <option value="SD" <?php if($student->state==="SD"){echo "selected";} ?>>South Dakota</option>
                        <option value="TN" <?php if($student->state==="TN"){echo "selected";} ?>>Tennessee</option>
                        <option value="TX" <?php if($student->state==="TZ"){echo "selected";} ?>>Texas</option>
                        <option value="UT" <?php if($student->state==="UT"){echo "selected";} ?>>Utah</option>
                        <option value="VT" <?php if($student->state==="VT"){echo "selected";} ?>>Vermont</option>
                        <option value="VA" <?php if($student->state==="VA"){echo "selected";} ?>>Virginia</option>
                        <option value="WA" <?php if($student->state==="WA"){echo "selected";} ?>>Washington</option>
                        <option value="WV" <?php if($student->state==="WV"){echo "selected";} ?>>West Virginia</option>
                        <option value="WI" <?php if($student->state==="WI"){echo "selected";} ?>>Wisconsin</option>
                        <option value="WY" <?php if($student->state==="WY"){echo "selected";} ?>>Wyoming</option>
                    </select><br>
                    <small class="errorMessage" id="cityerror">City: required; e.g. Golden</small><small class="errorMessage" id="stateerror">State: required; e.g. CO</small><br>
                    <input class="input-left" id="zip" type="text" name="zip" value="<?php echo $student->zip; ?>"><br>
                    <small class="errorMessage" id="ziperror">Zip: required; e.g. 80400</small><br>
                    <input class="input-left" id="county" type="text" name="county" value="<?php echo $student->county; ?>">&nbsp;County<br>
                    <small class="errorMessage" id="countyerror">County: required; e.g. Jefferson</small><br>
                    <input class="input-left" id="phone" type="text" name="phone" value="<?php echo $student->phone; ?>"><br>
                    <small class="errorMessage" id="phoneerror">Phone Number: required; ex. 303-555-5555</small><br>
                </fieldset>
                </div>
            </div>
            <div class="row-border"></div>
            <div class="row">
                <div class="col-1-2">
                <fieldset>
                    <input class="input-left first" type="text" name="chapter" readonly value="<?php echo $student->chapter; ?>">&nbsp;Chapter
                    <br><small></small><br>
                    <p>Username:</p><input id="username" type="text" name="username" value="<?php echo $student->username; ?>"><br>
                    <small class="errorMessage" id="usernameerror">Username: letters and numbers only</small><br>
                    <p>Change<br>Password:</p><input id="password" type="password" name="password"><br>
                    <small class="errorMessage" id="passworderror">Password: 8 character min; 1 uppercase, 1 lowercase, 1 number</small><br>
                    <p>Confirm<br>Password:</p><input id="confirmpassword" type="password" name="confirmpassword"><br>
                    <small class="errorMessage" id="confirmpassworderror">This password does not match.</small><br>
                    <input class="input-left" type="text" name="country" readonly value="<?php echo $student->country; ?>">
                    <br><small></small><br>
                    <input class="input-left" id="email" type="email" name="email" value="<?php echo $student->email; ?>"><br>
                    <small class="errorMessage" id="emailerror">e-mail: required; e.g. email@cyl.org</small><br>
                </fieldset>
                </div><div class="col-border">
                </div><div class="col-2-2">
                <fieldset>
                    <p class="first">Birthdate:</p><input type="text" name="birthdate" readonly value="<?php echo $student->birthdate; ?>" size="9">
                    <br><small></small><br>
                    <p>High School:</p><input id="highschool" type="text" name="highschool" value="<?php echo $student->highschool; ?>" size="25"><br>
                    <small class="errorMessage" id="highschoolerror">High School: required; e.g. Golden High School</small><br>
                    <p>Standing:</p><!--<input id="standing" type="text" name="standing" value="Senior"><br>-->
                    <select id="standing" name="standing">
                        <option value="Freshman" <?php if($student->standing==="Freshman"){echo "selected";} ?>>Freshman</option>
                        <option value="Sophomore" <?php if($student->standing==="Sophomore"){echo "selected";} ?>>Sophomore</option>
                        <option value="Junior" <?php if($student->standing==="Junior"){echo "selected";} ?>>Junior</option>
                        <option value="Senior" <?php if($student->standing==="Senior"){echo "selected";} ?>>Senior</option>
                        <option class="underscore" disabled>&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;</option>
                        <option value="Alumni" <?php if($student->standing==="Alumni"){echo "selected";} ?>>Alumni</option>
                    </select><br>
                    <small class="errorMessage" id="standingerror">Year: required; Freshman, Sophomore, Junior, Senior, Alumni</small><br>
                    <p>Graduation Date:</p><input id="graddate" type="text" name="graddate" value="<?php echo $student->graddate; ?>" size="5"><br>
                    <small class="errorMessage" id="graddateerror">Graduation Date: required; e.g. mm/yy</small><br>
                    <p>Extracurricular Activities:</p><br><textarea id="activities" name="activities" rows="5" cols="30"><?php echo $student->activities; ?></textarea>
                </fieldset>                    
                </div>
            </div>
            <div class="row-border"></div>
            <div class="row">
                <div class="col-1-2">
                <fieldset>
                    <p class="first">CYL Hours Completed:</p><input type="text" name="hourscompleted" readonly value="<?php echo $student->hourscompleted; ?>" size="5">
                    <br><br>
                    <p>Summit Level:</p><input type="text" name="summitlevel" readonly value="<?php echo $student->summitlevel; ?>" size="13">
                    <br><br>
                    <p>Summit Badges (click to share using <img src="../img/fb.png" height="15px" width="15px"> ):</p><br><p></p>
                        <?php if($student->summitlevel=="Democrat"){echo "<img id=\"fb_shareDemocrat\" class=\"shareButton\" src=\"../img/MtDemocrat.png\" height=\"80px\" width=\"80px\" alt=\"Badge\">";} 
                              if($student->summitlevel=="Cameron"){echo "<img id=\"fb_shareDemocrat\" class=\"shareButton\" src=\"../img/MtDemocrat.png\" height=\"80px\" width=\"80px\" alt=\"Badge\">
                                                                         <img id=\"fb_shareCameron\" class=\"shareButton\" src=\"../img/MtCameron.png\" height=\"80px\" width=\"80px\" alt=\"Badge\">";} 
                              if($student->summitlevel=="Lincoln"){echo "<img id=\"fb_shareDemocrat\" class=\"shareButton\" src=\"../img/MtDemocrat.png\" height=\"80px\" width=\"80px\" alt=\"Badge\">
                                                                         <img id=\"fb_shareCameron\" class=\"shareButton\" src=\"../img/MtCameron.png\" height=\"80px\" width=\"80px\" alt=\"Badge\">
                                                                         <img id=\"fb_shareLincoln\" class=\"shareButton\" src=\"../img/MtLincoln.png\" height=\"80px\" width=\"80px\" alt=\"Badge\">";} 
                              if($student->summitlevel=="Bross"){echo "<img id=\"fb_shareDemocrat\" class=\"shareButton\" src=\"../img/MtDemocrat.png\" height=\"80px\" width=\"80px\" alt=\"Badge\">
                                                                       <img id=\"fb_shareCameron\" class=\"shareButton\" src=\"../img/MtCameron.png\" height=\"80px\" width=\"80px\" alt=\"Badge\">
                                                                       <img id=\"fb_shareLincoln\" class=\"shareButton\" src=\"../img/MtLincoln.png\" height=\"80px\" width=\"80px\" alt=\"Badge\">
                                                                       <img id=\"fb_shareBross\" class=\"shareButton\" src=\"../img/MtBross.png\" height=\"80px\" width=\"80px\" alt=\"Badge\">";}
                        ?>
                    <br>
                    <p>LEM Badges:</p><br><p></p>
                    <img src="/img/exampleLEMbadges.jpg" alt="LEM Badges">
                    <br><br>
                    <p>Preferred Nonprofit Partner:</p><br><input class="input-left" id="preferrednonprofit" type="text" name="preferrednonprofit" value="<?php echo $student->preferrednonprofit; ?>" size="25"><br>
                    <small class="errorMessage" id="preferrednonprofiterror">Preferred Nonprofit Partner: letters only</small><br>
                </fieldset> 
                </div><div class="col-border">
                </div><div class="col-2-2">                   
                <fieldset>
                    <p class="first">CYL Alumni:</p><!--<input id="alumni" type="text" name="alumni" value="<?php echo $student->alumni; ?>" size="29"><br>-->
                    <select id="alumni" name="alumni">
                        <option value ="" <?php if($student->alumni===""){echo "selected";} ?>></option>
                        <option class="underscore" disabled>&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;</option>
                        <option value="Volunteer" <?php if($student->alumni==="Volunteer"){echo "selected";} ?>>Volunteer</option>
                        <option value="Intern" <?php if($student->alumni==="Intern"){echo "selected";} ?>>Intern</option>
                        <option value="Staff" <?php if($student->alumni==="Staff"){echo "selected";} ?>>Staff</option>
                        <option value="Board Member" <?php if($student->alumni==="Board Member"){echo "selected";} ?>>Board Member</option>
                        <option class="underscore" disabled>&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;</option>
                        <option value="Other" <?php if($student->alumni==="Other"){echo "selected";} ?>>Other</option>
                    </select><br>
                    <small class="errorMessage" id="alumnierror">CYL Alumni: Volunteer, Intern, Staff, Board Member, Other</small><br>
                    <p>Internship:</p><input id="internship" type="text" name="internship" value="<?php echo $student->internship; ?>" size="32"><br>
                    <small class="errorMessage" id="internshiperror">Internship: letters only</small><br>
                    <p>University/College:</p><input id="university" type="text" name="university" value="<?php echo $student->university; ?>" size="25"><br>
                    <small class="errorMessage" id="universityerror">University/College: letters only</small><br>
                    <p>Work Experience:</p><input id="work" type="text" name="work" value="<?php echo $student->work; ?>" size="26"><br>
                    <small class="errorMessage" id="workerror">Work Experience: letters only</small><br>
                    <p>Letters of Recommendation:</p><br><input class="file input-left" type="file" name="letter" accept="application/msword, application/vnd.openxmlformats-officedocument.wordprocessingml.document"><br>
                    <p>Resume:</p><br><input class="file input-left" type="file" name="resume" accept="application/msword, application/vnd.openxmlformats-officedocument.wordprocessingml.document"><br>
                </fieldset>
                </div>
            </div>
            <div class="submit">
                <input type="submit" value="Save Changes">
            </div>
            <div class="row-border"></div>
            <!--
            <div class="reporting">
                <h3>Reporting</h3>
                <img class="graph" src="img/graph.jpg" alt="Chart" height="100">
                <br><br>
            </div>
            -->
            </form>
        </main>
        
        <?php
            include '../aside.html';
            include '../footer.html';
        ?>
    </body>
</html>