<?php
class Task{
    private $conn;
    public $id;
    public $task;
    public $is_completed;

    public function __construct($db){
        $this->conn = $db;
    }

    public function read(){
       $query = "SELECT * FROM tasks";
       return $this->conn->query($query); 
    }

    public function create(){
        // "INSERT INTO tasks(task) VALUES('task')"
        $query = "INSERT INTO tasks(task) VALUES('" . $this->task . "')";

        return $this->conn->query($query); 
    }

    public function update($is_completed){
        // Ensure $is_completed is properly sanitized and converted to integer
        // Default to 0 if NULL
        $is_completed_value = ($is_completed !== null) ? (int)$is_completed : 0;
        
        // Make sure the SQL query has proper syntax
        $query = "UPDATE tasks SET is_completed = $is_completed_value WHERE id = " . $this->id;
        return $this->conn->query($query); 
    }

    public function delete(){
        $query = "DELETE FROM tasks WHERE id = " . $this->id;
        return $this->conn->query($query);
    }
}