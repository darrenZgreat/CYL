<?php
    include 'Student.php';
    include 'DatabaseConnect.php';

    
    function getStudent($id)
    {
        try {
            $connection = getConnection();
            $sql = "SELECT firstName, lastName, date_format(memberSince, '%c/%d/%Y') AS memberSince, 
		addressStreet, addressCity, addressState, addressZip, addressCounty, country, 
                chapter, username, password,
                contactPreference1, contactPreference1Info, contactPreference2, contactPreference2Info, 
                contactPreference3, contactPreference3Info, 
                date_format(birthdate, '%c/%d/%Y') AS birthdate, highSchool, highSchoolStanding, 
                date_format(highSchoolGraduationDate, '%c/%y') AS highSchoolGraduationDate, 
                activities, hoursCompleted, summitLevel, preferredNonprofit, alumni, internship, 
                university, work from StudentProfileNew WHERE idStudentProfile=$id";
            $result = $connection->query($sql);
            $student = new Student();
            foreach($result as $row) {
                $student->firstname = $row["firstName"];
                $student->lastname = $row["lastName"];
                $student->since = $row["memberSince"];
                $student->chapter = $row["chapter"];
                $student->street = $row["addressStreet"];
                $student->city = $row["addressCity"];
                $student->state = $row["addressState"];
                $student->zip = $row["addressZip"];
                $student->county = $row["addressCounty"];
                $student->country = $row["country"];
                $student->username = $row["username"];
                //$student->password = $row["password"];
                $student->contactPreference1 = $row["contactPreference1"];
                $student->contactPreference1Info = $row["contactPreference1Info"];
                $student->contactPreference2 = $row["contactPreference2"];
                $student->contactPreference2Info = $row["contactPreference2Info"];
                $student->contactPreference3 = $row["contactPreference3"];
                $student->contactPreference3Info = $row["contactPreference3Info"];
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
                $sql = "UPDATE StudentProfileNew SET addressStreet='$student->street', "
                    . "addressCity='$student->city', addressState='$student->state', "
                    . "addressZip='$student->zip', addressCounty='$student->county', "
                    . "contactPreference1='$student->contactPreference1', contactPreference1Info='$student->contactPreference1Info', "
                    . "contactPreference2='$student->contactPreference2', contactPreference2Info='$student->contactPreference2Info', "
                    . "contactPreference3='$student->contactPreference3', contactPreference3Info='$student->contactPreference3Info', "
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
                $sql = "UPDATE StudentProfileNew SET addressStreet='$student->street', "
                    . "addressCity='$student->city', addressState='$student->state', "
                    . "addressZip='$student->zip', addressCounty='$student->county', "
                    . "password='$student->password', "
                    . "contactPreference1='$student->contactPreference1', contactPreference1Info='$student->contactPreference1Info', "
                    . "contactPreference2='$student->contactPreference2', contactPreference2Info='$student->contactPreference2Info', "
                    . "contactPreference3='$student->contactPreference3', contactPreference3Info='$student->contactPreference3Info', "
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
                $sql = "SELECT count(idStudentProfile) AS num FROM StudentProfileNew WHERE username='$student->username'";
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
            $sql = "UPDATE StudentProfileNew SET username='$student->username' WHERE idStudentProfile=$id";
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
            $sql = "UPDATE StudentProfileNew SET firstName='$student->firstname', lastName='$student->lastname', "
                . "memberSince=str_to_date('$student->since', '%c/%e/%Y'), chapter='$student->chapter', addressStreet='$student->street', "
                . "addressCity='$student->city', addressState='$student->state', "
                . "addressZip='$student->zip', addressCounty='$student->county', "
                . "country='$student->country', "
                . "username='$student->username', password='$student->password', "
                . "contactPreference1='$student->contactPreference1', contactPreference1Info='$student->contactPreference1Info', "
                . "contactPreference2='$student->contactPreference2', contactPreference2Info='$student->contactPreference2Info', "
                . "contactPreference3='$student->contactPreference3', contactPreference3Info='$student->contactPreference3Info', "
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
            $sql = "INSERT INTO StudentProfileNew (firstName, lastName, memberSince, chapter, addressStreet, addressCity, addressState, addressZip, "
                 . "addressCounty, country, username, password, contactPreference1, contactPreference1Info, "
                 . "contactPreference2, contactPreference2Info, contactPreference3, contactPreference3Info, "
                 . "birthdate, highSchool, highSchoolStanding, "
                 . "highSchoolGraduationDate, activities, hoursCompleted, summitLevel, preferredNonprofit, alumni, internship, "
                 . "university, work) VALUES ('$student->firstname', '$student->lastname', str_to_date('$student->since', '%c/%e/%Y'), '$student->chapter', "
                 . "'$student->street', '$student->city', '$student->state', '$student->zip', '$student->county', '$student->country', "
                 . "'$student->username', '$student->password', "
                 . "'$student->contactPreference1', '$student->contactPreference1Info', '$student->contactPreference2', "
                 . "'$student->contactPreference2Info', '$student->contactPreference3', '$student->contactPreference3Info', "
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
            $sql = "DELETE FROM StudentProfileNew WHERE idStudentProfile=$id";
            $connection->exec($sql);
            $connection=null;
        } catch (Exception $e) {
            echo "EXCEPTION: Delete failed : ".$e->getMessage();
        }
    }
?>

