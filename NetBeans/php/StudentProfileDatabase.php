<?php
    include 'StudentProfileStudent.php';
    include 'StudentProfileState.php';
    include 'DatabaseConnect.php';

    function getStates()
    {
        $states = array();
        try {
            $connection = getConnection();
            $sql = "SELECT state_name, abrev FROM state";
            $result = $connection->query($sql);
            $i = 0;
            foreach($result as $row)
            {
                $s = new State();
                $s->name = $row["state_name"];
                $s->abrev = $row["abrev"];
                $states[$i++] = $s;
            }
        } catch (Exception $ex) {
            echo "EXCEPTION: Update failed : ".$e->getMessage();
        }
        
        return $states;
    }
    
    function getStudent($id)
    {
        try {
            $student = new Student();
            $connection = getConnection();
            
            $sql = "SELECT firstName, lastName, date_format(date_created, '%c/%d/%Y') as date_created, date_format(birthDate, '%c/%d/%Y') AS birthDate, highSchool, highSchoolYear, date_format(gradDate, '%c/%y') AS gradDate, activities, preferredNonProfit, alumni, internship, university_college, work_experience, county FROM user WHERE user_id=$id";
            $result = $connection->query($sql);
            foreach($result as $row)
            {
                $student->firstname = $row["firstName"];
                $student->lastname = $row["lastName"];
                $student->since = $row["date_created"];
                $student->birthdate = $row["birthDate"];
                $student->highschool = $row["highSchool"];
                $student->standing = $row["highSchoolYear"];
                $student->graddate = $row["gradDate"];
                $student->activities = $row["activities"];
                $student->preferrednonprofit = $row["preferredNonProfit"];
                $student->alumni = $row["alumni"];
                $student->internship = $row["internship"];
                $student->university = $row["university_college"];
                $student->work = $row["work_experience"];
                $student->county = $row["county"];
            }
            
            $sql = "SELECT chapter_name FROM chapter WHERE chapter_id=(SELECT chapter_id FROM user WHERE user_id=$id)";
            $result = $connection->query($sql);
            foreach($result as $row)
            {
                $student->chapter=$row["chapter_name"];
            }
            
            $sql = "SELECT street, city, state, country, zip FROM address WHERE user_id=$id";
            $result = $connection->query($sql);
            foreach($result as $row)
            {
                $student->street = $row["street"];
                $student->city = $row["city"];
                $student->state = $row["state"];
                $student->country = $row["country"];
                $student->zip = $row["zip"];
            }
            
            $sql = "SELECT username FROM login WHERE user_id=$id";
            $result = $connection->query($sql);
            foreach($result as $row)
            {
                $student->username = $row["username"];
            }
            
            $sql = "SELECT summit_name FROM summit WHERE summit_id=(SELECT summit_id FROM user_summit WHERE user_id=$id order by stop_date is null desc, stop_date desc limit 1);";
            $result = $connection->query($sql);
            foreach($result as $row)
            {
                $student->summitlevel = $row["summit_name"];
            }
            
            $sql = "SELECT SUM(hours_worked) as hours FROM user_event WHERE user_id=$id";
            $result = $connection->query($sql);
            foreach($result as $row)
            {
                $student->hourscompleted = $row["hours"];
            }
            
            $sql = "SELECT contact_type_name FROM contact_type WHERE contact_type_id=(SELECT contact_type_id FROM contact WHERE user_id=$id AND contact_pref=1);";
            $result = $connection->query($sql);
            foreach($result as $row)
            {
                $student->contactPreference1 = $row["contact_type_name"];
            }
            $sql = "SELECT contact_point FROM contact WHERE user_id=$id AND contact_pref=1";
            $result = $connection->query($sql);
            foreach($result as $row)
            {
                $student->contactPreference1Info = $row["contact_point"];
            }
            $sql = "SELECT contact_type_name FROM contact_type WHERE contact_type_id=(SELECT contact_type_id FROM contact WHERE user_id=$id AND contact_pref=2);";
            $result = $connection->query($sql);
            foreach($result as $row)
            {
                $student->contactPreference2 = $row["contact_type_name"];
            }
            $sql = "SELECT contact_point FROM contact WHERE user_id=$id AND contact_pref=2";
            $result = $connection->query($sql);
            foreach($result as $row)
            {
                $student->contactPreference2Info = $row["contact_point"];
            }
            $sql = "SELECT count(contact_id) as count FROM (SELECT contact_id FROM contact WHERE user_id=$id AND contact_pref=3) as temp";
            $result = $connection->query($sql);
            foreach($result as $row)
            {
                if($row["count"]==0)
                {
                    $student->contactPreference3="none";
                    $student->contactPreference3Info="";
                }
                else
                {
                    $sql = "SELECT contact_type_name FROM contact_type WHERE contact_type_id=(SELECT contact_type_id FROM contact WHERE user_id=$id AND contact_pref=3);";
                    $result = $connection->query($sql);
                    foreach($result as $row)
                    {
                        $student->contactPreference3 = $row["contact_type_name"];
                    }
                    $sql = "SELECT contact_point FROM contact WHERE user_id=$id AND contact_pref=3";
                    $result = $connection->query($sql);
                    foreach($result as $row)
                    {
                        $student->contactPreference3Info = $row["contact_point"];
                    }
                }
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
            
            if($student->password != "")
            {
                $sql = "UPDATE login SET passwrd='$student->password' WHERE user_id=$id";
                $connection->exec($sql);
            }
            
            $sql = "UPDATE address SET street='$student->street', city='$student->city', state='$student->state', country='$student->country', zip='$student->zip' WHERE user_id=$id";
            $connection->exec($sql);
            
            $sql = "UPDATE user SET highSchool='$student->highschool', highSchoolYear='$student->standing', gradDate=str_to_date('$student->graddate', '%c/%y'), activities='$student->activities', preferredNonProfit='$student->preferrednonprofit', alumni='$student->alumni', internship='$student->internship', university_college='$student->university', work_experience='$student->work', county='$student->county' WHERE user_id=$id";
            $connection->exec($sql);
            
            $sql = "UPDATE contact SET contact_type_id=(SELECT contact_type_id FROM contact_type WHERE contact_type_name='$student->contactPreference1') WHERE user_id=$id AND contact_pref=1";
            $connection->exec($sql);
            $sql = "UPDATE contact SET contact_point='$student->contactPreference1Info' WHERE user_id=$id AND contact_pref=1";
            $connection->exec($sql);
            $sql = "UPDATE contact SET contact_type_id=(SELECT contact_type_id FROM contact_type WHERE contact_type_name='$student->contactPreference2') WHERE user_id=$id AND contact_pref=2";
            $connection->exec($sql);
            $sql = "UPDATE contact SET contact_point='$student->contactPreference2Info' WHERE user_id=$id AND contact_pref=2";
            $connection->exec($sql);
            $sql = "SELECT count(contact_id) as count FROM (SELECT contact_id FROM contact WHERE user_id=$id AND contact_pref=3) as temp";
            $result = $connection->query($sql);
            foreach($result as $row)
            {
                if($row["count"]==0)
                {
                    if($student->contactPreference3!="none")
                    {
                        $sql = "INSERT INTO contact VALUES (NULL, '$student->contactPreference3Info', (SELECT contact_type_id FROM contact_type WHERE contact_type_name='$student->contactPreference3'), 3, $id, NULL)";
                        $connection->exec($sql);
                    }
                }
                else 
                {
                    if($student->contactPreference3=="none")
                    {
                        $sql = "DELETE FROM contact WHERE user_id=$id AND contact_pref=3";
                        $connection->exec($sql);
                    }
                    else
                    {
                        $sql = "UPDATE contact SET contact_type_id=(SELECT contact_type_id FROM contact_type WHERE contact_type_name='$student->contactPreference3') WHERE user_id=$id AND contact_pref=3";
                        $connection->exec($sql);
                        $sql = "UPDATE contact SET contact_point='$student->contactPreference3Info' WHERE user_id=$id AND contact_pref=3";
                        $connection->exec($sql);  
                    }
                }
            }
            
            if($student->fileNameProfilePic != "")
            {
                $sql = "SELECT count(file_name) as count FROM user_file_upload WHERE user_id=$id AND file_name='$student->fileNameProfilePic'";
                $result = $connection->query($sql);
                foreach($result as $row)
                {
                    if($row["count"]==0)
                    {
                        $sql = "INSERT INTO user_file_upload VALUES (NULL, '$student->fileNameProfilePic', CURRENT_TIMESTAMP(), $id)";
                        $connection->exec($sql);
                    }
                }
            }
            
            if($student->fileNameLetter != "")
            {
                $sql = "SELECT count(file_name) as count FROM user_file_upload WHERE user_id=$id AND file_name='$student->fileNameLetter'";
                $result = $connection->query($sql);
                foreach($result as $row)
                {
                    if($row["count"]==0)
                    {
                        $sql = "INSERT INTO user_file_upload VALUES (NULL, '$student->fileNameLetter', CURRENT_TIMESTAMP(), $id)";
                        $connection->exec($sql);
                    }
                }
            }
            
            if($student->fileNameResume != "")
            {
                $sql = "SELECT count(file_name) as count FROM user_file_upload WHERE user_id=$id AND file_name='$student->fileNameResume'";
                $result = $connection->query($sql);
                foreach($result as $row)
                {
                    if($row["count"]==0)
                    {
                       $sql = "INSERT INTO user_file_upload VALUES (NULL, '$student->fileNameResume', CURRENT_TIMESTAMP(), $id)";
                        $connection->exec($sql); 
                    }
                }  
            }
            
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
                $sql = "SELECT count(login_id) AS count FROM login WHERE username='$student->username'";
                $result = $connection ->query($sql);
                foreach($result as $row)
                {
                    if($row["count"]==0)
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
            $sql = "UPDATE login SET username='$student->username' WHERE user_id=$id";
            $connection->exec($sql);
            $connection=null;
        } catch (Exception $e) {
            echo "EXCEPTION: Update failed : ".$e->getMessage();
        }
    }
?>

