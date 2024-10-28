<?php
    require_once 'dbcon.php';
class Student extends Database{
    private $name;
    private $age;
    private $class;
    private $email;

    private $conn;

    public function __construct($name=null, $age=null, $class=null,$email=null)
    {
        $this->conn=$this->connect();
        $this->name=$name;
        $this->age=$age;
        $this->class=$class;
        $this->email=$email;
    

}



// public function getStudents(){
//     $query= "SELECT * FROM `students`";
//     $stmt=$this->conn->prepare($query);
//     if($stmt->execute()){
//         return $stmt->fetchAll(PDO::FETCH_ASSOC);
//     }
//     else{
//         return false;
//     }

// }

public function getStudent($id){
    $query= "SELECT * FROM `students` WHERE `id`=:id";
    $stmt=$this->conn->prepare($query);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    if($stmt->execute()){
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    else{
        return false;
    }


}



public function deleteStudent($id){
    $query="DELETE  FROM students  WHERE `id`=:id";
    $stmt=$this->conn->prepare($query);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);

    return $stmt->execute();
  
}



public function searchStudent($search) {
    $query = "SELECT * FROM `students` 
              WHERE `name` LIKE :name
              OR `class` = :class 
              OR `email` LIKE :email 
              OR `age` = :age";
    
    $stmt = $this->conn->prepare($query);

  
    $searchTerm = "%" . $search . "%";

    if (is_numeric($search)) {

        $stmt->bindValue(':age', (int)$search, PDO::PARAM_INT);
    } else {
    
        $stmt->bindValue(':age', null, PDO::PARAM_NULL);
    }

  
    $stmt->bindValue(':name', $searchTerm);
    $stmt->bindValue(':class', $search); 
    $stmt->bindValue(':email', $searchTerm);

    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


}

class Graduation extends Student {
    private $name;
    private $age;
    private $class;
    private $email;
    private $graduation_year; 

    private $conn;

    public function __construct($name = null, $age = null, $class = null, $email = null, $graduation_year = null) {
        $this->conn = $this->connect();
        $this->name = $name;
        $this->age = $age;
        $this->class = $class;
        $this->email = $email;
        $this->graduation_year = $graduation_year; 
    }
    public function getStudents(){
        $query= "SELECT * FROM `students`";
        $stmt=$this->conn->prepare($query);
        if($stmt->execute()){
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        else{
            return false;
        }
    
    }

    public function addstudents() {
        $query = "INSERT INTO `students`(name, age, class, email, graduation_year) VALUES(:name, :age, :class, :email, :graduation_year)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":age", $this->age, PDO::PARAM_INT);
        $stmt->bindParam(":class", $this->class);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":graduation_year", $this->graduation_year, PDO::PARAM_INT);

        return $stmt->execute();
    }


    public function updateStudents($id) {
        $query = "UPDATE `students` SET `name` = :name, `age` = :age, `class` = :class, `email` = :email, `graduation_year` = :graduation_year WHERE `id` = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":age", $this->age, PDO::PARAM_INT);
        $stmt->bindParam(":class", $this->class);
        $stmt->bindParam(":email", $this->email);
        $stmt->bindParam(":graduation_year", $this->graduation_year, PDO::PARAM_INT); 

        return $stmt->execute();
    }

   
}


?>	