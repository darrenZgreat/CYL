function validate() {
	var error = {numErrors: 0, textColor:"black", errorColor:"#ffa3a3", okColor:"white"};
        
        validateElement("work", /^(([a-z]+ {0,1})+){0,1}$/i, error);
        validateElement("university", /^(([a-z]+ {0,1})+){0,1}$/i, error);
        validateElement("internship", /^(([a-z]+ {0,1})+){0,1}$/i, error);
        validateElement("alumni", /^((Volunteer)|(Intern)|(Staff)|(Board Member)|(Other)){0,1}$/i, error);        
        
        validateElement("preferrednonprofit", /^(([a-z]+ {0,1})+){0,1}$/i, error);
        
	validateElement("graddate", /^(12{0,1}|11{0,1}|10{0,1}|(0{0,1}[1-9]))\/[0-9][0-9]$/i, error);
        validateElement("standing", /^((Freshman)|(Sophomore)|(Junior)|(Senior)|(Alumni))$/i, error);
	validateElement("highschool", /^([a-z]+ {0,1})+$/i, error);        
        
        validateElement("email", /^.+@.+\..+$/, error);
        if(document.getElementById("password").value !== document.getElementById("confirmpassword").value)
        {
            document.getElementById("confirmpassword").style.backgroundColor = error.errorColor;
            document.getElementById("confirmpassword").focus();
            document.getElementById("confirmpassword"+"error").style.visibility="visible";
            error.numErrors++;
        }
        else
        {
            document.getElementById("confirmpassword").style.backgroundColor = error.okColor;
            document.getElementById("confirmpassword"+"error").style.visibility="hidden";
        }
        validateElement("password", /^((?=.*[0-9])(?=.*[a-z])(?=.*[A-Z]).{8,}){0,1}$/, error);
	validateElement("username", /^([a-z]|[0-9])+$/i, error);
        
        validateElement("phone", /^[0-9]{3}-[0-9]{3}-[0-9]{4}$/, error);
        validateElement("county", /^([a-z]+ {0,1})+$/i, error);
        validateElement("zip", /^[0-9]{5}$/, error);
        validateElement("state", /^((AL)|(AK)|(AZ)|(AR)|(CA)|(CO)|(CT)|(DE)|(DC)|(FL)|(GA)|(HI)|(ID)|(IL)|(IN)|(IA)|(KS)|(KY)|(LA)|(ME)|(MD)|(MA)|(MI)|(MN)|(MS)|(MO)|(MT)|(NE)|(NV)|(NH)|(NJ)|(NM)|(NY)|(NC)|(ND)|(OH)|(OK)|(OR)|(PA)|(RI)|(SC)|(SD)|(TN)|(TX)|(UT)|(VT)|(VA)|(WA)|(WV)|(WI)|(WY))$/i, error);
        validateElement("city", /^([a-z]+ {0,1})+$/i, error);
        validateElement("street", /^[0-9]+ ([a-z]+ {0,1})+$/i, error);
  
	if(error.numErrors>0) return false;
	else return true;
}

function validateElement(id, regex, error)
{
	var input = document.getElementById(id).value;
	if(!regex.test(input))
	{
		document.getElementById(id).style.backgroundColor = error.errorColor;
                document.getElementById(id).focus();
                document.getElementById(id+"error").style.visibility="visible";
		error.numErrors++;
	}
	else
        {
            document.getElementById(id).style.backgroundColor = error.okColor;
            document.getElementById(id+"error").style.visibility="hidden";
        }
}
