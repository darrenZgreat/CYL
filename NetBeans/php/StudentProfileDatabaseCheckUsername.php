<?php

    include 'StudentProfileDatabase.php';

    $id = $_POST["id"];
    $username = $_POST["username"];
    $studentCurrent = getStudent($id);
    if($studentCurrent->username != $username)
    {
        try {
            $connection = getConnection();
            $sql = "SELECT count(login_id) AS count FROM login WHERE username='$username'";
            $result = $connection ->query($sql);
            foreach($result as $row)
            {
                if($row["count"]==0)
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