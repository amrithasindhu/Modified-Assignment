<?php

require_once("student.php");

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['delete_student'])) {
    $id = $_POST['id'] ?? null;

   


    $studentObj = new Student();
    if ($studentObj->deleteStudent('students',$id)) {
        header("Location: mainpage.php?success=deleted");
        exit();
    } else {
        header("Location: mainpage.php?error=delete");
        exit();
    }
} else {
   
    header("Location: index.php");
    exit();
}
?>
