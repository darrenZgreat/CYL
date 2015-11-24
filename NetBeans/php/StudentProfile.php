<?php
class Student {
    //public $id = 0;
    public $firstname = "";
    public $lastname = ""; 
    public $since = "";
    public $chapter = "";
    public $street = "";
    public $city = "";
    public $state = "";
    public $zip = "";
    public $county = "";
    public $country = "";
    public $username = "";
    public $password = "";
    public $confirmpassword = "";
    public $contactPreference1 = "";
    public $contactPreference1Info = "";
    public $contactPreference2 = "";
    public $contactPreference2Info = "";
    public $contactPreference3 = "";
    public $contactPreference3Info = "";
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
                preg_match("/^([a-z]|[0-9])+$/i", $this->username) &&
                preg_match("/^((?=.*[0-9])(?=.*[a-z])(?=.*[A-Z]).{8,}){0,1}$/", $this->password) &&
                $this->password===$this->confirmpassword &&
                preg_match("/^((Phone)|(Text)|(Email))$/i", $this->contactPreference1) &&
                preg_match("/^((Phone)|(Text)|(Email))$/i", $this->contactPreference2) &&
                preg_match("/^((Phone)|(Text)|(Email)|(None))$/i", $this->contactPreference3) &&
                ( (($this->contactPreference1=="Phone" || $this->contactPreference1=="Text") && preg_match("/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/", $this->contactPreference1Info)) || ($this->contactPreference1=="Email" && preg_match("/^.+@.+\..+$/", $this->contactPreference1Info)) ) &&
                ( (($this->contactPreference2=="Phone" || $this->contactPreference2=="Text") && preg_match("/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/", $this->contactPreference2Info)) || ($this->contactPreference2=="Email" && preg_match("/^.+@.+\..+$/", $this->contactPreference2Info)) ) &&
                ( (($this->contactPreference3=="Phone" || $this->contactPreference3=="Text") && preg_match("/^[0-9]{3}-[0-9]{3}-[0-9]{4}$/", $this->contactPreference3Info)) || ($this->contactPreference3=="Email" && preg_match("/^.+@.+\..+$/", $this->contactPreference3Info)) || ($this->contactPreference3=="None" && $this->contactPreference3Info == "") ) &&
                preg_match("/^([a-z]+ {0,1})+$/i", $this->highschool) &&
                preg_match("/^((Freshman)|(Sophomore)|(Junior)|(Senior)|(Alumni))$/i", $this->standing) &&
                preg_match("/^([10-12]{0,1}|(0{0,1}[1-9]))\/[0-9][0-9]$/i", $this->graddate) &&
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
                "chapter: " . $this->chapter . "<br>" .
                "street: " . $this->firstname . "<br>" .
                "city: " . $this->city . "<br>" .
                "state: " . $this->state . "<br>" .
                "zip: " . $this->zip . "<br>" .
                "county: " . $this->county . "<br>" .
                "country: " . $this->country . "<br>" .
                "username: " . $this->username . "<br>" .
                "password: " . $this->password . "<br>" .
                "confirmpassword: " . $this->password . "<br>" .
                "contactPreference1: " . $this->contactPreference1 . "<br>" .
                "contactPreference1Info: " . $this->contactPreference1Info . "<br>" .
                "contactPreference2: " . $this->contactPreference2 . "<br>" .
                "contactPreference2Info: " . $this->contactPreference2Info . "<br>" .
                "contactPreference3: " . $this->contactPreference3 . "<br>" .
                "contactPreference3Info: " . $this->contactPreference3Info . "<br>" .
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



