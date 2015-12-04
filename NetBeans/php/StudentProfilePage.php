<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js" type="text/javascript"></script>
        <script src="../js/StudentProfileFacebook.js"></script>

        <script src="../js/StudentProfileScripts.js"></script>
        <script src="../js/scripts.js"></script>
        <link href="../css/StudentProfileStyles.css" rel="stylesheet">
        <link href="../css/styles.css" rel="stylesheet">

        <title>Student Profile</title>
    </head>
    <body>
        <?php
            include '../header.html';
            include 'StudentProfileDatabase.php';
            $identifier = 1;
            $student = getStudent($identifier);
        ?>
        <div class="header-buffer"></div>
        <main>
            <form enctype="multipart/form-data" action="StudentProfileUpdate.php" method="post" onsubmit="return validate(<?php echo $identifier ?>)">
            <div class="tall">
                <div class="col-1-3">
                    <fieldset class="tall">
                    <figure>
                        <img class="picture" src="../uploads/<?php echo $student->firstname.$student->lastname ?> ProfilePic.jpg" alt="Profile Picture">
                    </figure>
                    <input id="pictureupload" class="file file-picture" type="file" name="picture" accept="image/jpeg" onchange="validatePicture()">
                    <br><small class="errorMessage" id="pictureuploaderror"></small><br>
                </fieldset>
                </div><div class="col-2-3">
                <fieldset class="tall">
                    <input class="input-left first" type="text" name="firstname" readonly value="<?php echo $student->firstname; ?>">
                    <input class="input-left" type="text" name="lastname" readonly value="<?php echo $student->lastname; ?>">
                    <br><small></small><br>
                    <p>Member<br>Since:</p>&nbsp;<input type="text" name="since" readonly value="<?php echo $student->since; ?>" size="10">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<p>Chapter:</p>&nbsp;<input id="chapter" class="input-left first" type="text" name="chapter" readonly value="<?php echo $student->chapter; ?>" size="14">
                    <br><small></small><br>
                    <input class="input-left" id="street" type="text" name="street" value="<?php echo $student->street; ?>" onkeyup="validateStreet()"><br>
                    <small class="errorMessage" id="streeterror"></small><br>
                    <input class="input-left" id="city" type="text" name="city" value="<?php echo $student->city; ?>" onkeyup="validateCity()">
                    <select id="state" name="state" onchange="validateState()">
                        <?php
                            $states = getStates();
                            foreach($states as $state)
                            {
                                if($student->state===$state->abrev || $student->state===$state->name)
                                {
                                    echo "<option value='$state->abrev' selected>$state->name</option>";
                                }
                                else
                                {
                                    echo "<option value='$state->abrev'>$state->name</option>";
                                } 
                            }
                        ?>
                    </select><br>
                    <small class="errorMessage" id="cityerror"></small><br>
                    <input class="input-left" id="zip" type="text" name="zip" value="<?php echo $student->zip; ?>" onkeyup="validateZip()"><br>
                    <small class="errorMessage" id="ziperror"></small><br>
                    <input class="input-left" id="county" type="text" name="county" value="<?php echo $student->county; ?>" onkeyup="validateCounty()">&nbsp;County<br>
                    <small class="errorMessage" id="countyerror"></small><br>
                    <input class="input-left" type="text" name="country" readonly value="<?php echo $student->country; ?>">
                    <br><small></small><br>
                </fieldset>
                </div><div class="col-3-3">
                <fieldset>
                    <p class="first">Username:</p>&nbsp;<input id="username" type="text" name="username" value="<?php echo $student->username; ?>" onkeyup="validateUsername(<?php echo $identifier ?>)"><br>
                    <small class="errorMessage" id="usernameerror"></small><br>
                    <p>Change<br>Password:</p>&nbsp;&nbsp;<input id="password" type="password" name="password" onkeyup="validateConfirmPassword(); validatePassword(); focus()"><br>
                    <small class="errorMessage" id="passworderror"></small><br>
                    <p>Confirm<br>Password:</p>&nbsp;&nbsp;<input id="confirmpassword" type="password" name="confirmpassword" onkeyup="validateConfirmPassword()"><br>
                    <small class="errorMessage" id="confirmpassworderror"></small><br>
                    <p>Contact<br>Preference 1:&nbsp;</p><select id="contactPreference1" name="contactPreference1" onchange="validateContactPreference('contactPreference1')">
                        <option value="phone" <?php if($student->contactPreference1==="phone"){echo "selected";} ?>>Phone</option>
                        <option value="text" <?php if($student->contactPreference1==="text"){echo "selected";} ?>>Text</option>
                        <option value="email" <?php if($student->contactPreference1==="email"){echo "selected";} ?>>Email</option>
                    </select>&nbsp;&nbsp;<input class="input-left" id="contactPreference1Info" type="text" name="contactPreference1Info" value="<?php echo $student->contactPreference1Info; ?>" onkeyup="validateContactPreference('contactPreference1'), setFocus('contactPreference1Info')"><br>
                    <small class="errorMessage" id="contactPreference1Infoerror"></small><br>
                    <p>Contact<br>Preference 2:&nbsp;</p><select id="contactPreference2" name="contactPreference2" onchange="validateContactPreference('contactPreference2')">
                        <option value="phone" <?php if($student->contactPreference2==="phone"){echo "selected";} ?>>Phone</option>
                        <option value="text" <?php if($student->contactPreference2==="text"){echo "selected";} ?>>Text</option>
                        <option value="email" <?php if($student->contactPreference2==="email"){echo "selected";} ?>>Email</option>
                    </select>&nbsp;&nbsp;<input class="input-left" id="contactPreference2Info" type="text" name="contactPreference2Info" value="<?php echo $student->contactPreference2Info; ?>" onkeyup="validateContactPreference('contactPreference2'), setFocus('contactPreference2Info')"><br>
                    <small class="errorMessage" id="contactPreference2Infoerror"></small><br>
                    <p>Contact<br>Preference 3:&nbsp;</p><select id="contactPreference3" name="contactPreference3" onchange="validateContactPreference('contactPreference3')">
                        <option value="none">None</option>
                        <option class="underscore" disabled>&mdash;&mdash;&mdash;</option>
                        <option value="phone" <?php if($student->contactPreference3==="phone"){echo "selected";} ?>>Phone</option>
                        <option value="text" <?php if($student->contactPreference3==="text"){echo "selected";} ?>>Text</option>
                        <option value="email" <?php if($student->contactPreference3==="email"){echo "selected";} ?>>Email</option>
                    </select>&nbsp;&nbsp;<input class="input-left" id="contactPreference3Info" type="text" name="contactPreference3Info" value="<?php echo $student->contactPreference3Info; ?>" style="<?php if($student->contactPreference3==='none'){echo 'visibility: hidden';} ?>" onkeyup="validateContactPreference('contactPreference3'), setFocus('contactPreference3Info')"><br>
                    <small class="errorMessage" id="contactPreferenceerror">--------------------------------</small><small class="errorMessage" id="contactPreference3Infoerror"></small><br>
                </fieldset>
                </div>
            </div>
            <div class="row-border"></div>
            <div class="row">
                <div class="col-1-2">
                <fieldset>
                    <p class="first">Birthdate:</p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="birthdate" readonly value="<?php echo $student->birthdate; ?>" size="9">
                    <br><small></small><br>
                    <p>High School:</p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input id="highschool" type="text" name="highschool" value="<?php echo $student->highschool; ?>" onkeyup="validateHighschool()" size="25"><br>
                    <small class="errorMessage" id="highschoolerror"></small><br>
                    <p>Standing:</p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <select id="standing" name="standing" onchange="validateStanding()">
                        <option value="Freshman" <?php if($student->standing==="Freshman"){echo "selected";} ?>>Freshman</option>
                        <option value="Sophomore" <?php if($student->standing==="Sophomore"){echo "selected";} ?>>Sophomore</option>
                        <option value="Junior" <?php if($student->standing==="Junior"){echo "selected";} ?>>Junior</option>
                        <option value="Senior" <?php if($student->standing==="Senior"){echo "selected";} ?>>Senior</option>
                        <option class="underscore" disabled>&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;</option>
                        <option value="Alumni" <?php if($student->standing==="Alumni"){echo "selected";} ?>>Alumni</option>
                    </select><br><br>
                    <p>Graduation Date:</p>&nbsp;<input id="graddate" type="text" name="graddate" value="<?php echo $student->graddate; ?>" onkeyup="validateGraddate()" size="5"><br>
                    <small class="errorMessage" id="graddateerror"></small><br>
                    <p>Extracurricular Activities:</p><br>
                    <textarea id="activities" name="activities" rows="7" cols="35"><?php echo $student->activities; ?></textarea>
                </fieldset>
                </div><div class="col-border">
                </div><div class="col-2-2">
                <fieldset>
                    <p class="first">CYL Hours Completed:</p>&nbsp;<input type="text" name="hourscompleted" readonly value="<?php echo $student->hourscompleted; ?>" size="5">
                    <br><br>
                    <p>Summit Level:</p>&nbsp;<input type="text" name="summitlevel" readonly value="<?php echo $student->summitlevel; ?>" size="12">
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
                    <p>LEM Badges Placeholder:</p><br><p></p>
                    <img src="/img/exampleLEMbadges.jpg" alt="LEM Badges">
                    <br><br>
                    <p>Preferred Nonprofit Partner:</p><br><input class="input-left" id="preferrednonprofit" type="text" name="preferrednonprofit" value="<?php echo $student->preferrednonprofit; ?>" onkeyup="validatePreferrednonprofit()" size="25"><br>
                    <small class="errorMessage" id="preferrednonprofiterror"></small><br>
                </fieldset>
                </div>
            </div>
            <div class="row-border"></div>
            <div class="row">
                <div class="col-1-2">
                <fieldset>
                    <p class="first">CYL Alumni:</p>
                    &nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;&nbsp
                    <select id="alumni" name="alumni" onchange="validateAlumni()">
                        <option value ="" <?php if($student->alumni===""){echo "selected";} ?>></option>
                        <option class="underscore" disabled>&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;</option>
                        <option value="Volunteer" <?php if($student->alumni==="Volunteer"){echo "selected";} ?>>Volunteer</option>
                        <option value="Intern" <?php if($student->alumni==="Intern"){echo "selected";} ?>>Intern</option>
                        <option value="Staff" <?php if($student->alumni==="Staff"){echo "selected";} ?>>Staff</option>
                        <option value="Board Member" <?php if($student->alumni==="Board Member"){echo "selected";} ?>>Board Member</option>
                        <option class="underscore" disabled>&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;&mdash;</option>
                        <option value="Other" <?php if($student->alumni==="Other"){echo "selected";} ?>>Other</option>
                    </select><br><br>
                    <p>Internship:</p>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input id="internship" type="text" name="internship" value="<?php echo $student->internship; ?>" onkeyup="validateInternship()" size="24"><br>
                    <small class="errorMessage" id="internshiperror"></small><br>
                    <p>University/College:</p>&nbsp;<input id="university" type="text" name="university" value="<?php echo $student->university; ?>" onkeyup="validateUniversity()" size="24"><br>
                    <small class="errorMessage" id="universityerror"></small><br>
                    <p>Work Experience:</p>&nbsp;&nbsp;&nbsp;&nbsp;<input id="work" type="text" name="work" value="<?php echo $student->work; ?>" onkeyup="validateWork()" size="24"><br>
                    <small class="errorMessage" id="workerror"></small><br>
                    <p>Letters of Recommendation:</p><br><input id="letterupload" class="file input-left" type="file" name="letter" onchange="validateLetter()" accept="application/msword, application/vnd.openxmlformats-officedocument.wordprocessingml.document">
                    <br><small class="errorMessage" id="letteruploaderror"></small><br>
                    <p>Resume:</p><br><input id="resumeupload" class="file input-left" type="file" name="resume" onchange="validateResume()" accept="application/msword, application/vnd.openxmlformats-officedocument.wordprocessingml.document" onchange="validateResume()">
                    <br><small class="errorMessage" id="resumeuploaderror"></small><br>
                </fieldset>
                </div><div class="col-border">
                </div><div class="col-2-2">
                    <div class="reporting">
                        <h3>Reporting Placeholder</h3>
                        <img class="graph" src="../img/exampleGraph.jpg" alt="Chart" height="100">
                        <br><br>
                    </div>
                </div>
            </div>
            <div class="submit">
                <input type="submit" value="Save Changes">
            </div>
            <div class="row-border"></div>
            </form>
        </main>

        <?php
            include '../footer.html';
        ?>
    </body>
</html>
