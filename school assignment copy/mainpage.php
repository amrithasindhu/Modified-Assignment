
<?php
include("header.php");
include("dbcon.php");
include("student.php");
$studentObj = new Graduation();
$students = $studentObj->getStudents( 'students');
$isAdmin = isset($_GET['user_type']) && $_GET['user_type'] === 'admin';
?>
<div class="box1">
<?php if ($isAdmin): ?>
<button type="button" class="btn btn-primary" data-bs-toggle ="modal" data-bs-target="#exampleModal">
Add Students
</button>
<?php endif; ?>

<form action="search.php" method="POST">
<label for="search"></label>
   
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
            <?php if($isAdmin):?>
            <th>Update</th>
            <th>Delete</th>
            <?php endif; ?>
         


          
    
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

                
                    <td>
                    <?php if ($isAdmin): ?>
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#updateModal<?php echo $student['id']; ?>">
                                Update
                            </button>
                            <?php endif; ?>
                            <div class="modal fade" id="updateModal<?php echo $student['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel<?php echo $student['id']; ?>" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <form action="update.php" method="POST">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="updateModalLabel<?php echo $student['id']; ?>">Update Student</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                          
                                                <input type="hidden" name="id" value="<?php echo $student['id']; ?>">

                               
                                                <div class="form-group mb-3">
                                                    <label for="name<?php echo $student['id']; ?>"> Name</label>
                                                    <?php 
                                                        $nameParts = explode(' ', $student['name'], 2);
                                                        $name = $nameParts[0];
                                                      
                                                    ?>
                                                    <input type="text" name="name" class="form-control" placeholder=" Name" value="<?php echo htmlspecialchars($name); ?>" required>
                                                </div>
                          
                                               
                                 
                                                <div class="form-group mb-3">
                                                    <label for="age<?php echo $student['id']; ?>">Age</label>
                                                    <input type="number" name="age" class="form-control" placeholder="Age" value="<?php echo htmlspecialchars($student['age']); ?>" required>
                                                </div>
                               
                                                <div class="form-group mb-3">
        <label for="class<?php echo $student['id']; ?>">Class</label>
        <input type="text" name="class" class="form-control" placeholder="Class" value="<?php echo htmlspecialchars($student['class']); ?>" required>
    </div>
                             
                                                <div class="form-group mb-3">
                                                    <label for="email<?php echo $student['id']; ?>">Email</label>
                                                    <input type="email" name="email" class="form-control" placeholder="Email" value="<?php echo htmlspecialchars($student['email']); ?>" required>
                                                </div>
                                                <div class="form-group mb-3">
    <label for="graduation_year<?php echo $student['id']; ?>">Graduation Year</label>
    <input type="text" name="graduation_year" class="form-control" placeholder="Graduation Year" value="<?php echo htmlspecialchars($student['graduation_year']); ?>">
</div>


                                          
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <input type="submit" class="btn btn-success" name="update_student" value="Update">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>






                    </td>
                    <td>
                    <?php if ($isAdmin): ?>
                    <form action="delete.php" method="POST" onsubmit="return confirm('Are you sure you want to delete this student?');">
                                <input type="hidden" name="id" value="<?php echo $student['id']; ?>">
                                <input type="submit" class="btn btn-danger" name="delete_student" value="Delete">
                            </form>
                            <?php endif; ?> 
                            </button>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="7">No students found.</td>
            </tr>
        <?php endif; ?>
        

        </tbody>
        </table>
        <?php if ($isAdmin): ?>
        <form  action="insert_data.php" method="POST">
        <?php endif; ?> 
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form action="insert.php" method="POST">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Student</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="form-group mb-3">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control" placeholder="Name" required>
          </div>

          <div class="form-group mb-3">
            <label for="age">Age</label>
            <input type="number" name="age" class="form-control" placeholder="Age" required>
          </div>

          <div class="form-group mb-3">
            <label for="class">Class</label>
            <input type="text" name="class" class="form-control" placeholder="Class" required>
          </div>

          <div class="form-group mb-3">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" placeholder="Email" required>
          </div>

          <div class="form-group mb-3">
    <label for="graduation_year">Graduation Year</label>
    <input type="text" name="graduation_year" class="form-control" placeholder="Graduation Year" >
</div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <input type="submit" class="btn btn-success" name="add_students" value="Add">
        </div>
      </div>
    </form>
  </div>
</div>

</form>







                       

        <?php include("footer.php"); ?>