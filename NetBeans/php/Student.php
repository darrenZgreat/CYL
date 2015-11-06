<?php
class Student {
    //public $id = 0;
    public $firstname = "";
    public $lastname = ""; 
    public $since = "";
    public $street = "";
    public $city = "";
    public $state = "";
    public $zip = "";
    public $county = "";
    public $phone = "";
    public $chapter = "";
    public $username = "";
    public $password = "";
    public $confirmpassword = "";
    public $country = "";
    public $email = "";
    public $birthdate = "";
    public $highschool = "";
    public $standing = "";
    public $graddate = "";
    public $activities = "";
    public $hourscompleted = "";
    public $summitlevel = "";
    public $preferrednonprofit = "";
    public $alumni = "";
    public $internship = "";
    public $university = "";
    public $work = "";
    
    public function validate() {
        return preg_match('/^[0-9]+ ([a-z]+ {0,1})+$/i', $this->street) &&
                preg_match('/^([a-z]+ {0,1})+$/i', $this->city) &&
                preg_match('/^((AL)|(AK)|(AZ)|(AR)|(CA)|(CO)|(CT)|(DE)|(DC)|(FL)|(GA)|(HI)|(ID)|(IL)|(IN)|(IA)|(KS)|(KY)|(LA)|(ME)|(MD)|(MA)|(MI)|(MN)|(MS)|(MO)|(MT)|(NE)|(NV)|(NH)|(NJ)|(NM)|(NY)|(NC)|(ND)|(OH)|(OK)|(OR)|(PA)|(RI)|(SC)|(SD)|(TN)|(TX)|(UT)|(VT)|(VA)|(WA)|(WV)|(WI)|(WY))$/i', $this->state) &&
                preg_match("/^[0-9]{5}$/", $this->zip) &&
                preg_match("/^([a-z]+ {0,1})+$/i", $this->county) &&
                preg_match("/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/", $this->phone) &&
                preg_match("/^([a-z]|[0-9])+$/i", $this->username) &&
                preg_match("/^((?=.*[0-9])(?=.*[a-z])(?=.*[A-Z]).{8,}){0,1}$/", $this->password) &&
                $this->password===$this->confirmpassword &&
                preg_match("/^.+@.+\..+$/", $this->email) &&
                preg_match("/^([a-z]+ {0,1})+$/i", $this->highschool) &&
                preg_match("/^((Freshman)|(Sophomore)|(Junior)|(Senior)|(Alumni))$/i", $this->standing) &&
                preg_match("/^(12{0,1}|11{0,1}|10{0,1}|(0{0,1}[1-9]))\/[0-9][0-9]$/i", $this->graddate) &&
                preg_match("/^(([a-z]+ {0,1})+){0,1}$/i", $this->preferrednonprofit) &&
                preg_match("/^((Volunteer)|(Intern)|(Staff)|(Board Member)|(Other)){0,1}$/i", $this->alumni) &&
                preg_match("/^(([a-z]+ {0,1})+){0,1}$/i", $this->internship) &&
                preg_match("/^(([a-z]+ {0,1})+){0,1}$/i", $this->university) &&
                preg_match("/^(([a-z]+ {0,1})+){0,1}$/i", $this->work);

    }
    public function toString() {
        return "firstname: " . $this->firstname . "<br>" .
                "lastname: " . $this->lastname . "<br>" .
                "since: " . $this->since . "<br>" .
                "street: " . $this->firstname . "<br>" .
                "city: " . $this->city . "<br>" .
                "state: " . $this->state . "<br>" .
                "zip: " . $this->zip . "<br>" .
                "county: " . $this->county . "<br>" .
                "phone: " . $this->phone . "<br>" .
                "chapter: " . $this->chapter . "<br>" .
                "username: " . $this->username . "<br>" .
                "password: " . $this->password . "<br>" .
                "confirmpassword: " . $this->password . "<br>" .
                "country: " . $this->country . "<br>" .
                "email: " . $this->email . "<br>" .
                "birthdate: " . $this->birthdate . "<br>" .
                "highschool: " . $this->highschool . "<br>" .
                "graddate: " . $this->graddate . "<br>" .
                "standing: " . $this->standing . "<br>" .
                "activities: " . $this->activities . "<br>" .
                "firstname: " . $this->firstname . "<br>" .
                "hourscompleted: " . $this->summitlevel . "<br>" .
                "preferrednonprofit: " . $this->preferrednonprofit . "<br>" .
                "firstname: " . $this->firstname . "<br>" .
                "alumni: " . $this->alumni . "<br>" .
                "internship: " . $this->internship . "<br>" .
                "university: " . $this->university . "<br>" .
                "work: " . $this->work . "<br>";
    }
}
?>



