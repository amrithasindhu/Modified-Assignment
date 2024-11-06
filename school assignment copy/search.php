


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Students</title>
</head>
<body>
<?php
    require_once 'dbcon.php'; 
    require_once 'Student.php'; 
    if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['search_students'])) {
        $searchInput = $_POST['search'];

  $student = new Student();

    
        $results = $student->searchStudent('students',$searchInput);

      
        echo $results ? "<h2>Search Results:</h2>" : "<p>No students found matching your search.</p>";


        if ($results) {
            echo "<table border='1'>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Age</th>
                        <th>Class</th>
                        <th>Email</th>
                        <th>Graduation Year</th>
                    </tr>";

            foreach ($results as $student) {
                echo "<tr>
                        <td>{$student['id']}</td>
                        <td>{$student['name']}</td>
                        <td>{$student['age']}</td>
                        <td>{$student['class']}</td>
                        <td>{$student['email']}</td>
                        <td>{$student['graduation_year']}</td>
                      </tr>";
            }
            echo "</table>";
        }
    }
    ?>


</body>
</html>
