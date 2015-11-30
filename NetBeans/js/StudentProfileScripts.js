var error = {numErrors: 0, pictureUploadError: false, letterUploadError: false, resumeUploadError: false, errorColor:"white", okColor:"white"};

function validate(identifier) {
    error.numErrors = 0;
    error.errorColor = "#ffa3a3";

    validateWork();
    validateUniversity();
    validateInternship();
    validateAlumni();

    validatePreferrednonprofit();

    validateGraddate();
    validateStanding();
    validateHighschool();       

    validateContactPreference('contactPreference3');
    validateContactPreference('contactPreference2');
    validateContactPreference('contactPreference1');
    validateConfirmPassword();
    validatePassword();
    validateUsername(identifier);

    validateCounty();
    validateZip();
    validateState();
    validateCity();
    validateStreet();
    
    if(error.numErrors>0 || error.pictureUploadError || error.letterUploadError || error.resumeUploadError) 
    {
        if(error.pictureUploadError)
        {
            document.getElementById("pictureupload").focus();
        }
        else if(error.letterUploadError)
        {
            document.getElementById("letterupload").focus();
        }
        else if(error.resumeUploadError)
        {
            document.getElementById("resumeupload").focus();
        }
        return false;
    }
    else
    {
        return true;
    }
}

function validatePicture()
{
    var fileUpload = document.getElementById("pictureupload");
    var errorElement = document.getElementById("pictureuploaderror");
    errorElement.style.visibility="hidden";

    if (typeof(fileUpload.files)!=="undefined" && typeof(fileUpload.files[0])!=="undefined")
    {
        if(fileUpload.files[0].size>2100000)
        {
            errorElement.innerHTML="That picture is greater than 2.1MB in size, try again.";
            errorElement.style.visibility="visible";
            error.pictureUploadError = true;
        }
        else
        {
            //Initiate the FileReader object.
            var reader = new FileReader();
            //Read the contents of Image File.
            reader.readAsDataURL(fileUpload.files[0]);
            reader.onload = function (e) {
                //Initiate the JavaScript Image object.
                var image = new Image();
                //Set the Base64 string return from FileReader as source.
                image.src = e.target.result;

                //Validate the File Height and Width.
                image.onload = function () {
                    var height = this.height;
                    var width = this.width;
                    if (height !== width) 
                    {
                        errorElement.innerHTML="That picture is not a square, try again.";
                        errorElement.style.visibility="visible";
                        error.pictureUploadError = true;
                    }
                    else 
                    {
                        error.pictureUploadError = false;
                    }
                };

            };
        }
    
    }
}

function validateLetter()
{
    var fileUpload = document.getElementById("letterupload");
    var errorElement = document.getElementById("letteruploaderror");
    errorElement.style.visibility="hidden";

    if (typeof(fileUpload.files)!=="undefined" && typeof(fileUpload.files[0])!=="undefined")
    {
        if(fileUpload.files[0].size>2100000)
        {
            errorElement.innerHTML="Your file is greater than 2.1MB in size, try again.";
            errorElement.style.visibility="visible";
            error.letterUploadError=true;
        }
        else 
        {
            error.letterUploadError=false;
        }    
    }
}

function validateResume()
{
    var fileUpload = document.getElementById("resumeupload");
    var errorElement = document.getElementById("resumeuploaderror");
    errorElement.style.visibility="hidden";

    if (typeof(fileUpload.files)!=="undefined" && typeof(fileUpload.files[0])!=="undefined")
    {
        if(fileUpload.files[0].size>2100000)
        {
            errorElement.innerHTML="Your file is greater than 2.1MB in size, try again.";
            errorElement.style.visibility="visible";
            error.resumeUploadError=true;
        }
        else 
        {
            error.resumeUploadError=false;
        }    
    }
}

function validateElement(id, errorText, regex)
{
    var element = document.getElementById(id);
    var errorElement = document.getElementById(id+"error");
	var input = element.value;
	if(!regex.test(input))
	{
		element.style.backgroundColor = error.errorColor;
                element.focus();
                errorElement.innerHTML=errorText;
                errorElement.style.visibility="visible";
		error.numErrors++;
	}
	else
        {
            element.style.backgroundColor = error.okColor;
            errorElement.style.visibility="hidden";
        }
}

function validateStreet()
{
    validateElement("street", "Street Address: required; e.g. 822 Street Way", /^[0-9]+ ([a-z]+ {0,1})+$/i);
}

function validateCity()
{
    //message is followed by spaces to preserve spacing before the state  message
    validateElement("city", "City: required; e.g. Golden&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;", /^([a-z]+ {0,1})+$/i);
}

function validateState()
{
    validateElement("state", "State: required; e.g. CO", /^((AL)|(AK)|(AZ)|(AR)|(CA)|(CO)|(CT)|(DE)|(DC)|(FL)|(GA)|(HI)|(ID)|(IL)|(IN)|(IA)|(KS)|(KY)|(LA)|(ME)|(MD)|(MA)|(MI)|(MN)|(MS)|(MO)|(MT)|(NE)|(NV)|(NH)|(NJ)|(NM)|(NY)|(NC)|(ND)|(OH)|(OK)|(OR)|(PA)|(RI)|(SC)|(SD)|(TN)|(TX)|(UT)|(VT)|(VA)|(WA)|(WV)|(WI)|(WY))$/i);
}

function validateZip()
{
    validateElement("zip", "Zip: required; e.g. 80400", /^[0-9]{5}$/);
}

function validateCounty()
{
    validateElement("county", "County: required; e.g. Jefferson", /^([a-z]+ {0,1})+$/i);
}

function validateUsername(identifier)
{
    var id = "username";
    var errorText = "Required; letters and numbers only";
    var regex = /^([a-z]|[0-9])+$/i;
    
    var element = document.getElementById(id);
    var errorElement = document.getElementById(id+"error");
    var input = element.value;
    if(!regex.test(input))
    {
            element.style.backgroundColor = error.errorColor;
            element.focus();
            errorElement.innerHTML=errorText;
            errorElement.style.visibility="visible";
            error.numErrors++;
    }
    else if(id==="username")
    {
        var request = new XMLHttpRequest();
        request.onreadystatechange = function() {
            if(request.readyState===4 && request.status===200)
            {
                var text = request.responseText;
                var json = JSON.parse(text);
                if(json.usernameStatus==="used")
                {
                    element.style.backgroundColor = error.errorColor;
                    element.focus();
                    errorElement.innerHTML="That username is taken";
                    errorElement.style.visibility="visible";
                    error.numErrors++;
                }
                else
                {
                    element.style.backgroundColor = error.okColor;
                    errorElement.style.visibility="hidden";
                }
            }
        };
        request.open("POST", "StudentProfileDatabaseCheckUsername.php", false);
        request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        request.send("id="+identifier+"&"+"username="+input);
    }
    else
    {
        element.style.backgroundColor = error.okColor;
        errorElement.style.visibility="hidden";
    }
}

function validatePassword()
{
    validateElement("password", "8 character min; 1 uppercase, 1 lowercase, 1 number", /^((?=.*[0-9])(?=.*[a-z])(?=.*[A-Z]).{8,}){0,1}$/);
}

function validateConfirmPassword()
{
        var element = document.getElementById("confirmpassword");
        var errorElement =  document.getElementById("confirmpassword"+"error");
        if(document.getElementById("password").value !== element.value)
        {
            element.style.backgroundColor = error.errorColor;
            element.focus();
            errorElement.innerHTML="This password does not match";
            errorElement.style.visibility="visible";
            error.numErrors++;
        }
        else
        {
            element.style.backgroundColor = error.okColor;
            errorElement.style.visibility="hidden";
        }
}

function validatePhone(id)
{
    validateElement(id, "Phone: e.g. 303-555-5555", /^[0-9]{3}-[0-9]{3}-[0-9]{4}$/);
}

function validateText(id)
{
    validateElement(id, "Text: e.g. 303-555-5555", /^[0-9]{3}-[0-9]{3}-[0-9]{4}$/);
}

function validateEmail(id)
{
    validateElement(id, "Email: e.g. email@cyl.org", /^.+@.+\..+$/);
}

function validateContactPreference(id)
{
    var currentElement = document.getElementById(id);
    var currentElement2 = document.getElementById(id+"Info");
    var selected = currentElement.value;
    var element1 = document.getElementById("contactPreference1");
    var element2 = document.getElementById("contactPreference2");
    var element3 = document.getElementById("contactPreference3");
    var errorElement = document.getElementById(id+"Infoerror");
    var errorElement2 = document.getElementById('contactPreferenceerror');
    currentElement2.style.visibility="visible";
    errorElement2.style.visibility="hidden";
    
    if(document.getElementById('contactPreference1').value!=="Email" && document.getElementById('contactPreference2').value!=="Email" && document.getElementById('contactPreference3').value!=="Email")
    {
        if(element3.value==="None")
        {
            element3.focus();
        }
        else
        {
            if(id!=="contactPreference1")
            {
                element1.focus();
            }
            else
            {
                element2.focus();
            }
        }
        errorElement2.innerHTML="Please provide your Email";
        errorElement2.style.visibility="visible";
        error.numErrors++;
    }
    else if(element1.value!=="Phone" && element2.value!=="Phone" && element3.value!=="Phone")
    {
        if(element3.value==="None")
        {
            element3.focus();
        }
        else
        {
            if(id!=="contactPreference1")
            {
                element1.focus();
            }
            else
            {
                element2.focus();
            }
        }
        errorElement2.innerHTML="Please provide your Phone";
        errorElement2.style.visibility="visible";
        error.numErrors++;
    }
    
    if(selected==='Phone')
    {
        validatePhone(id+"Info");
    }
    else if(selected==='Text')
    {
        validateText(id+"Info");
    }
    else if(selected==='Email')
    {
        validateEmail(id+"Info");
    }
    else if(selected==='None')
    {
        errorElement.style.visibility="hidden";
        currentElement2.value="";
        currentElement2.style.visibility="hidden";
    }
}

function setFocus(id) {
    document.getElementById(id).focus();
}

function validateHighschool()
{
    validateElement("highschool", "Required; e.g. Golden High School", /^([a-z]+ {0,1})+$/i); 
}

function validateStanding()
{
    validateElement("standing", "Required; Freshman, Sophomore, Junior, Senior, Alumni", /^((Freshman)|(Sophomore)|(Junior)|(Senior)|(Alumni))$/i);
}

function validateGraddate()
{
    validateElement("graddate", "Required; e.g. mm/yy", /^([10-12]{0,1}|(0{0,1}[1-9]))\/[0-9][0-9]$/i);
}

function validatePreferrednonprofit()
{
    validateElement("preferrednonprofit", "Letters and spaces only", /^(([a-z]+ {0,1})+){0,1}$/i);
}

function validateAlumni()
{
    validateElement("alumni", "Volunteer, Intern, Staff, Board Member, Other", /^((Volunteer)|(Intern)|(Staff)|(Board Member)|(Other)){0,1}$/i);
}

function validateInternship()
{
    validateElement("internship", "Letters and spaces only", /^(([a-z]+ {0,1})+){0,1}$/i);
}

function validateUniversity()
{
    validateElement("university", "Letters and spaces only", /^(([a-z]+ {0,1})+){0,1}$/i);
}

function validateWork()
{
    validateElement("work", "Letters and spaces only", /^(([a-z]+ {0,1})+){0,1}$/i);
}