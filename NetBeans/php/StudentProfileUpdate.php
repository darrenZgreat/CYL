<?php
    header("Location: StudentProfilePage.php");
    include 'StudentProfileDatabase.php';
    
    if($_FILES["picture"]["tmp_name"]!=null)
    {
        $image_info = getimagesize($_FILES["picture"]["tmp_name"]);
        $image_width = $image_info[0];
        $image_height = $image_info[1];
        if($image_height==$image_width)
        {
            move_uploaded_file($_FILES["picture"]["tmp_name"], "../uploads/".$_POST["firstname"].$_POST["lastname"]." ProfilePic.jpg");
        }
        else
        {
            echo "Picure height and width must be equal. Try Again.<br>";
        }
    }
    if($_FILES["letter"]["tmp_name"]!=null)
    {
        move_uploaded_file($_FILES["letter"]["tmp_name"], "../uploads/".$_POST["firstname"].$_POST["lastname"]." Letter - ".$_FILES["letter"]["name"]);
    }
    if($_FILES["resume"]["tmp_name"]!=null)
    {
        move_uploaded_file($_FILES["resume"]["tmp_name"], "../uploads/".$_POST["firstname"].$_POST["lastname"]." Resume - ".$_FILES["resume"]["name"]);
    }
    
    $student = new Student();
    $student->firstname=$_POST["firstname"];
    $student->lastname=$_POST["lastname"];
    $student->since=$_POST["since"];
    $student->chapter=$_POST["chapter"];
    $student->street=$_POST["street"];
    $student->city=$_POST["city"];
    $student->state=$_POST["state"];
    $student->zip=$_POST["zip"];
    $student->county=$_POST["county"];
    $student->country=$_POST["country"];
    $student->username=$_POST["username"];
    $student->password=$_POST["password"];
    $student->confirmpassword=$_POST["confirmpassword"];
    $student->contactPreference1=$_POST["contactPreference1"];
    $student->contactPreference1Info=$_POST["contactPreference1Info"];
    $student->contactPreference2=$_POST["contactPreference2"];
    $student->contactPreference2Info=$_POST["contactPreference2Info"];
    $student->contactPreference3=$_POST["contactPreference3"];
    $student->contactPreference3Info=$_POST["contactPreference3Info"];
    $student->birthdate=$_POST["birthdate"];
    $student->highschool=$_POST["highschool"];
    $student->standing=$_POST["standing"];
    $student->graddate=$_POST["graddate"];
    $student->activities=$_POST["activities"];
    $student->hourscompleted=$_POST["hourscompleted"];
    $student->summitlevel=$_POST["summitlevel"];
    $student->preferrednonprofit=$_POST["preferrednonprofit"];
    $student->alumni=$_POST["alumni"];
    $student->internship=$_POST["internship"];
    $student->university=$_POST["university"];
    $student->work=$_POST["work"];
    
    if($student->validate())
    {
        //$student->password = md5($student->password);
        updateStudent(1,$student);
        if(!checkUsername(1, $student))
        {
            updateUsername(1, $student);
        }
    }
    else 
    {
        echo "Check your input!<br>";
    }
    
?>