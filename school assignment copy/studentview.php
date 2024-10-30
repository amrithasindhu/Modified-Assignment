
<?php
include("header.php");
include("dbcon.php");
include("student.php");
$studentObj = new Graduation();
$students = $studentObj->getStudents();

?>
<div class="box1">


<form action="search.php" method="POST">
  <input type="text" name="search" placeholder="search ....">
  <input type="submit" class="btn btn-success" name="search_students" value="Search">

</form>



  </div>
    <table class="table table-hover table-bordered table-striped" >
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Age</th>
            <th>class</th>
            <th>Email</th>
            <th>Graduation Year</th>
           
         


            </tr>
    
        </tr>
        </thead>
        <tbody>
        <?php if ($students): ?>
            <?php foreach ($students as $student): ?>
                <tr>
                    <td><?php echo htmlspecialchars($student['id']); ?></td>
                    <td><?php echo htmlspecialchars($student['name']); ?></td>
                    <td><?php echo htmlspecialchars($student['age']); ?></td>
                    <td><?php echo htmlspecialchars($student['class']); ?></td>
                    <td><?php echo htmlspecialchars($student['email']); ?></td>
                    <td><?php echo htmlspecialchars($student['graduation_year']); ?></td>

          
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="7">No students found.</td>
            </tr>
        <?php endif; ?>
        

        </tbody>
        </table>
     
     






                       

        <?php include("footer.php"); ?>