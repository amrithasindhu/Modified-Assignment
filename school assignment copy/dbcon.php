<?php
class Database{
    private string $host="localhost";
    private string $user= "root";
    private string $pwd= "";
    private string $dbName= "school_db";

    public function connect(): PDO{

    try{

        $conn = "mysql:host={$this->host};dbname={$this->dbName}";
        $pdo = new PDO($conn, $this->user, $this->pwd);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
   
        return $pdo;

    }
    catch(PDOException $e){
        echo "Failed to establish a connection: " . $e->getMessage();

    }
    


}
}
?>