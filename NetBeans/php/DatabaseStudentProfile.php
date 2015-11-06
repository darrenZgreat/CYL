<?php
    include 'Student.php';
    include 'DatabaseConnect.php';

    
    function getStudent($id)
    {
        try {
            $connection = getConnection();
            $sql = "SELECT firstName, lastName, date_format(memberSince, '%c/%d/%Y') AS memberSince, 
		addressStreet, addressCity, addressState, addressZip, addressCounty, phone, 
                chapter, username, password, country, email, 
                date_format(birthdate, '%c/%d/%Y') AS birthdate, highSchool, highSchoolStanding, 
                date_format(highSchoolGraduationDate, '%c/%y') AS highSchoolGraduationDate, 
                activities, hoursCompleted, summitLevel, preferredNonprofit, alumni, internship, 
                university, work from StudentProfile WHERE idStudentProfile=$id";
            $result = $connection->query($sql);
            $student = new Student();
            foreach($result as $row) {
                $student->firstname = $row["firstName"];
                $student->lastname = $row["lastName"];
                $student->since = $row["memberSince"];
                $student->street = $row["addressStreet"];
                $student->city = $row["addressCity"];
                $student->state = $row["addressState"];
                $student->zip = $row["addressZip"];
                $student->county = $row["addressCounty"];
                $student->phone = $row["phone"];
                $student->chapter = $row["chapter"];
                $student->username = $row["username"];
                //$student->password = $row["password"];
                $student->country = $row["country"];
                $student->email = $row["email"];
                $student->birthdate = $row["birthdate"];
                $student->highschool = $row["highSchool"];
                $student->standing = $row["highSchoolStanding"];
                $student->graddate = $row["highSchoolGraduationDate"];
                $student->activities = $row["activities"];
                $student->hourscompleted = $row["hoursCompleted"];
                $student->summitlevel = $row["summitLevel"];
                $student->preferrednonprofit = $row["preferredNonprofit"];
                $student->alumni = $row["alumni"];
                $student->internship = $row["internship"];
                $student->university = $row["university"];
                $student->work = $row["work"];
            }
            
            $connection=null;
        } catch (Exception $e) {
            echo "EXCEPTION: Update failed : ".$e->getMessage();
        }
        return $student;
    }

    function updateStudent($id, $student)
    {
        try {
            $connection = getConnection();
            if($student->password === "")
            {
                $sql = "UPDATE StudentProfile SET addressStreet='$student->street', "
                    . "addressCity='$student->city', addressState='$student->state', "
                    . "addressZip='$student->zip', addressCounty='$student->county', "
                    . "phone='$student->phone', "
                    . "email='$student->email', "
                    . "highSchool='$student->highschool', highSchoolStanding='$student->standing', "
                    . "highSchoolGraduationDate=str_to_date('$student->graddate', '%c/%y'), "
                    . "activities='$student->activities', "
                    . "preferredNonprofit='$student->preferrednonprofit', alumni='$student->alumni', "
                    . "internship='$student->internship', university='$student->university', "
                    . "work='$student->work' "
                    . "WHERE idStudentProfile=$id";
            }
            else
            {
                $sql = "UPDATE StudentProfile SET addressStreet='$student->street', "
                    . "addressCity='$student->city', addressState='$student->state', "
                    . "addressZip='$student->zip', addressCounty='$student->county', "
                    . "phone='$student->phone', "
                    . "password='$student->password', email='$student->email', "
                    . "highSchool='$student->highschool', highSchoolStanding='$student->standing', "
                    . "highSchoolGraduationDate=str_to_date('$student->graddate', '%c/%y'), "
                    . "activities='$student->activities', "
                    . "preferredNonprofit='$student->preferrednonprofit', alumni='$student->alumni', "
                    . "internship='$student->internship', university='$student->university', "
                    . "work='$student->work' "
                    . "WHERE idStudentProfile=$id";                
            }
            $connection->exec($sql);
            $connection=null;
        } catch (Exception $e) {
            echo "EXCEPTION: Update failed : ".$e->getMessage();
        }
    }
    
    function checkUsername($id, $student)
    {
        $studentCurrent = getStudent($id);
        if($studentCurrent->username != $student->username)
        {
            try {
                $connection = getConnection();
                $sql = "SELECT count(idStudentProfile) AS num FROM StudentProfile WHERE username='$student->username'";
                $result = $connection ->query($sql);
                foreach($result as $row)
                {
                    if($row["num"]==0)
                    {
                        echo "ok";
                        return false;
                    }
                    else
                    {
                        echo "used";
                        return true;
                    }
                }
                $connection=null;
            } catch (Exception $e) {
                echo "EXCEPTION: Update failed : ".$e->getMessage();
            }
        }
        else
        {
            echo 'same';
            return true;
        }

    }
    
    function updateUsername($id, $student)
    {
        try {
            $connection = getConnection();
            $sql = "UPDATE StudentProfile SET username='$student->username' WHERE idStudentProfile=$id";
            $connection->exec($sql);
            $connection=null;
        } catch (Exception $e) {
            echo "EXCEPTION: Update failed : ".$e->getMessage();
        }
    }
    
    function updateStudentAll($id, $student)
    {
        try {
            $connection = getConnection();
            $sql = "UPDATE StudentProfile SET firstName='$student->firstname', lastName='$student->lastname', "
                . "memberSince=str_to_date('$student->since', '%c/%e/%Y'), addressStreet='$student->street', "
                . "addressCity='$student->city', addressState='$student->state', "
                . "addressZip='$student->zip', addressCounty='$student->county', "
                . "phone='$student->phone', chapter='$student->chapter', "
                . "username='$student->username', password='$student->password', country='$student->country', email='$student->email', "
                . "birthdate=str_to_date('$student->birthdate', '%c/%e/%Y'), highSchool='$student->highschool', highSchoolStanding='$student->standing', "
                . "highSchoolGraduationDate=str_to_date('$student->graddate', '%c/%y'), "
                . "activities='$student->activities', hoursCompleted='$student->hourscompleted', summitLevel='$student->summitlevel', "
                . "preferredNonprofit='$student->preferrednonprofit', alumni='$student->alumni', "
                . "internship='$student->internship', university='$student->university', work='$student->work' "
                . "WHERE idStudentProfile=$id";                
            $connection->exec($sql);
            $connection=null;
        } catch (Exception $e) {
            echo "EXCEPTION: Update failed : ".$e->getMessage();
        }
    }
    
    function addStudent($student)
    {
        try {
            $connection = getConnection();
            $sql = "INSERT INTO StudentProfile (firstName, lastName, memberSince, addressStreet, addressCity, addressState, addressZip, "
                 . "addressCounty, phone, chapter, username, password, country, email, birthdate, highSchool, highSchoolStanding, "
                 . "highSchoolGraduationDate, activities, hoursCompleted, summitLevel, preferredNonprofit, alumni, internship, "
                 . "university, work) VALUES ('$student->firstname', '$student->lastname', str_to_date('$student->since', '%c/%e/%Y'), "
                 . "'$student->street', '$student->city', '$student->state', '$student->zip', '$student->county', '$student->phone', "
                 . "'$student->chapter', '$student->username', '$student->password', '$student->country', '$student->email', "
                 . "str_to_date('$student->birthdate', '%c/%e/%Y'), '$student->highschool', '$student->standing', "
                 . "str_to_date('$student->graddate', '%c/%y'), '$student->activities', '$student->hourscompleted', '$student->summitlevel', "
                 . "'$student->preferrednonprofit', '$student->alumni', '$student->internship', '$student->university', '$student->work')";
            $connection->exec($sql);
            //$student->id = $connection ->lastInsertId();
            $connection=null;
        } catch (Exception $e) {
            echo "EXCEPTION: Insert failed : ".$e->getMessage();
        }
    }
    
    function deleteStudent($id)
    {
        try {
            $connection = getConnection();
            $sql = "DELETE FROM StudentProfile WHERE idStudentProfile=$id";
            $connection->exec($sql);
            $connection=null;
        } catch (Exception $e) {
            echo "EXCEPTION: Delete failed : ".$e->getMessage();
        }
    }
?>

