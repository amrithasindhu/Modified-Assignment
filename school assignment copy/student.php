<?php
require_once 'dbcon.php';
class Student extends Database
{
    protected $tableName = "students";





    public function deleteStudent($tablename, $id)
    {
        $query = "DELETE  FROM $tablename WHERE `id`=:id";
        $stmt = $this->connect()->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        return $stmt->execute();
    }


    public function searchStudent($tablename, $filters)
    {
        // if(!preg_match('/[^a-zA-Z0-9_]/',$tablename))
        // {
        //  throw new Exception("Invalid table name");
        // }

        if (!empty($filters)) {
            $columns = [];
            $params = [];

            foreach ($filters as $field => $value) {
                if (!preg_match('/^[a-zA-Z0-9_]+$/', $field)) {
                    throw new exception("Invalid column name:$field");
                }

                if (is_string($value)) {
                    $columns[] = "'$field' LIKE :$field";
                    $params[":field"] = "%$value%";
                } else {
                    $columns[] = "'$field' = :$field";
                    $params[":field"] = $value;
                }
            }
            $columnlist = implode(',', $columns);
            $query = "SELECT $columnlist FROM '$tablename'";

            $stmt = $this->connect()->prepare($query);


            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }
}

class Graduation extends Student
{





    public function getStudents($tablename, $columns = '*')
    {

        if ($columns !== '*') {
            
            $columns = implode(', ', array_map(function ($col) {
                return preg_replace('/[^a-zA-Z0-9_]/', '', $col);
            }, (array) $columns));
        }
        $query = "SELECT $columns FROM $tablename";
        $stmt = $this->connect()->prepare($query);
        if ($stmt->execute()) {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return false;
        }
    }

    public function addstudents($tablename, $data)
    {

///Change to array_key,array_values
        if (!empty($data)) {
            $field_name = $placeholder = [];
            foreach ($data as $field => $value) {
                $field_name[] = $field;
                $placeholder[] = " :{$field}";
            }
        }
        $query = "INSERT INTO $tablename (" . implode(',', $field_name) . ") VALUES (" . implode(',', $placeholder) . ")";
        $stmt = $this->connect()->prepare($query);

        foreach ($data as $field => $value) {
            $stmt->bindParam(":{$field}", $data[$field]);
        }

        return $stmt->execute();
    }


    public function updateStudents($tablename, $data, $id)
    {

        if (!empty($data)) {
            $field_name = [];
            foreach ($data as $field => $value) {
                $field_name[] = "{$field} = :{$field}";
            }

            $query = "UPDATE $tablename SET " . implode(',', $field_name) . " WHERE `id` = :id";
            $stmt = $this->connect()->prepare($query);
            foreach ($data as $field => $value) {
                $stmt->bindParam(":{$field}", $data[$field]);
            }
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);

            return $stmt->execute();
        }
        return false;
    }
}


?>	  