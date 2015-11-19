<?php

    include 'DatabaseStudentProfile.php';

    $id = $_POST["id"];
    $username = $_POST["username"];
    $studentCurrent = getStudent($id);
    if($studentCurrent->username != $username)
    {
        try {
            $connection = getConnection();
            $sql = "SELECT count(idStudentProfile) AS num FROM StudentProfileNew WHERE username='$username'";
            $result = $connection ->query($sql);
            foreach($result as $row)
            {
                if($row["num"]==0)
                {
                    echo ('{ "usernameStatus" : "'.'new'.'"}');
                    return false;
                }
                else
                {
                    echo ('{ "usernameStatus" : "'.'used'.'"}');
                    return true;
                }
            }
            $connection=null;
        } catch (Exception $e) {
            echo "EXCEPTION: Retrieval failed : ".$e->getMessage();
        }
    }
    else
    {
        echo ('{ "usernameStatus" : "'.'same'.'"}');
    }

?>