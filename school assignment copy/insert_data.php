<?php

require_once("dbcon.php"); 
require_once("student.php");

class incorrectvalues extends Exception {
    public function agecheck() {
        return 'Enter the age between 0 and 120. Also, the age should be a number';
    }
    public function classcheck() {
        return 'Enter the class';
    }
    public function emailcheck() {
        return 'Enter a valid email ID';
    }
    public function namecheck() {
        return 'Enter a valid name';
    }
}
if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['add_students'])) {
    $age = $_POST["age"];
    $email = $_POST["email"];
    $name = $_POST["name"];
    $class = $_POST['class'];
    $graduation_year = $_POST['graduation_year'];

    $errors = [];  

    try {
      
        if (!filter_var($age, FILTER_VALIDATE_INT, array("options" => array("min_range" => 0, "max_range" => 120)))) {
            $errors[] = 'Enter a valid age between 0 and 120.';
        } else {
            $studentage = $age;
        }

        
        if (empty($class)) {
            $errors[] = 'Enter the class.';
        } else {
            $studentclass = $class;
        }

    
        if (filter_var($email, FILTER_VALIDATE_EMAIL) == false) {
            $errors[] = 'Enter a valid email ID.';
        } else {
            $studentemail = $email;
        }

        
        $pattern = "/^[a-zA-Z\s']+$/";
        if (!preg_match($pattern, $name)) {
            $errors[] = 'Enter a valid name.';
        } else {
            $studentname = $name;
        }

        if (!empty($errors)) {
            echo '<script>alert("' . htmlspecialchars(implode('\\n', $errors)) . '");
            window.history.back();
            </script>';

            return;  
        }

 
        $studentObj = new Graduation($studentname, $studentage, $studentclass, $studentemail, $graduation_year);
        if ($studentObj->addstudents()) {
            header("Location: mainpage.php?success=1");
            exit();
        } else {
            header("Location: mainpage.php?error=1");
            exit();
        }
    } catch (Exception $e) {
        echo 'An unexpected error occurred: ' . $e->getMessage();
    }
} else {
    header("Location: index.php");
    exit();
}

?>
