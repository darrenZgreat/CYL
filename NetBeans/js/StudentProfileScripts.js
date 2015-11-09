function validate(identifier) {
	var error = {numErrors: 0, errorColor:"#ffa3a3", okColor:"white"};
        
        validateElement("work", "Letters and spaces only", /^(([a-z]+ {0,1})+){0,1}$/i, identifier, error);
        validateElement("university", "Letters and spaces only", /^(([a-z]+ {0,1})+){0,1}$/i, identifier, error);
        validateElement("internship", "Letters and spaces only", /^(([a-z]+ {0,1})+){0,1}$/i, identifier, error);
        validateElement("alumni", "Volunteer, Intern, Staff, Board Member, Other", /^((Volunteer)|(Intern)|(Staff)|(Board Member)|(Other)){0,1}$/i, identifier, error);        
        
        validateElement("preferrednonprofit", "Letters and spaces only", /^(([a-z]+ {0,1})+){0,1}$/i, identifier, error);
        
	validateElement("graddate", "Required; e.g. mm/yy", /^(12{0,1}|11{0,1}|10{0,1}|(0{0,1}[1-9]))\/[0-9][0-9]$/i, identifier, error);
        validateElement("standing", "Required; Freshman, Sophomore, Junior, Senior, Alumni", /^((Freshman)|(Sophomore)|(Junior)|(Senior)|(Alumni))$/i, identifier, error);
	validateElement("highschool", "Required; e.g. Golden High School", /^([a-z]+ {0,1})+$/i, identifier, error);        
        
        validateElement("email", "e-mail: required; e.g. email@cyl.org", /^.+@.+\..+$/, identifier, error);
        if(document.getElementById("password").value !== document.getElementById("confirmpassword").value)
        {
            document.getElementById("confirmpassword").style.backgroundColor = error.errorColor;
            document.getElementById("confirmpassword").focus();
            document.getElementById("confirmpassword"+"error").innerHTML="This password does not match";
            document.getElementById("confirmpassword"+"error").style.visibility="visible";
            error.numErrors++;
        }
        else
        {
            document.getElementById("confirmpassword").style.backgroundColor = error.okColor;
            document.getElementById("confirmpassword"+"error").style.visibility="hidden";
        }
        validateElement("password", "8 character min; 1 uppercase, 1 lowercase, 1 number", /^((?=.*[0-9])(?=.*[a-z])(?=.*[A-Z]).{8,}){0,1}$/, identifier, error);
	validateElement("username", "Required; letters and numbers only", /^([a-z]|[0-9])+$/i, identifier, error);
        
        validateElement("phone", "Phone Number: required; ex. 303-555-5555", /^[0-9]{3}-[0-9]{3}-[0-9]{4}$/, identifier, error);
        validateElement("county", "County: required; e.g. Jefferson", /^([a-z]+ {0,1})+$/i, identifier, error);
        validateElement("zip", "Zip: required; e.g. 80400", /^[0-9]{5}$/, identifier, error);
        validateElement("state", "State: required; e.g. CO", /^((AL)|(AK)|(AZ)|(AR)|(CA)|(CO)|(CT)|(DE)|(DC)|(FL)|(GA)|(HI)|(ID)|(IL)|(IN)|(IA)|(KS)|(KY)|(LA)|(ME)|(MD)|(MA)|(MI)|(MN)|(MS)|(MO)|(MT)|(NE)|(NV)|(NH)|(NJ)|(NM)|(NY)|(NC)|(ND)|(OH)|(OK)|(OR)|(PA)|(RI)|(SC)|(SD)|(TN)|(TX)|(UT)|(VT)|(VA)|(WA)|(WV)|(WI)|(WY))$/i, identifier, error);
        //padded with spaces to preserve spacing before state error message
        validateElement("city", "City: required; e.g. Golden&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;", /^([a-z]+ {0,1})+$/i, identifier, error);
        validateElement("street", "Street Address: required; e.g. 822 Street Way", /^[0-9]+ ([a-z]+ {0,1})+$/i, identifier, error);
  
	if(error.numErrors>0) return false;
	else return true;
}

function validateElement(id, errorText, regex, identifier, error)
{
	var input = document.getElementById(id).value;
	if(!regex.test(input))
	{
		document.getElementById(id).style.backgroundColor = error.errorColor;
                document.getElementById(id).focus();
                document.getElementById(id+"error").innerHTML=errorText;
                document.getElementById(id+"error").style.visibility="visible";
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
                        document.getElementById(id).style.backgroundColor = error.errorColor;
                        document.getElementById(id).focus();
                        document.getElementById(id+"error").innerHTML="That username is taken";
                        document.getElementById(id+"error").style.visibility="visible";
                        error.numErrors++;
                    }
                    else
                    {
                        document.getElementById(id).style.backgroundColor = error.okColor;
                        document.getElementById(id+"error").style.visibility="hidden";
                    }
                }
            };
            request.open("POST", "DatabaseCheckUsername.php", false);
            request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            request.send("id="+identifier+"&"+"username="+input);
        }
	else
        {
            document.getElementById(id).style.backgroundColor = error.okColor;
            document.getElementById(id+"error").style.visibility="hidden";
        }
}
