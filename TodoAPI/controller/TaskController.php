<?php
include "model/Task.php";
include "config/Database.php";

class TaskController{
    private $taskModel;

    public function __construct(){
        $database = new Database();
        $db= $database->connect();
        $this->taskModel = new Task($db);
    }
    
    public function addTask(){
        $jsonData = file_get_contents("php://input");
        
        // Check if input data exists
        if(empty($jsonData)) {
            header('HTTP/1.1 400 Bad Request');
            echo json_encode(["message" => "No data provided"]);
            return;
        }
        
        $data = json_decode($jsonData, true);
        
        // Check if data is properly decoded
        if ($data === null) {
            header('HTTP/1.1 400 Bad Request');
            echo json_encode(["message" => "Invalid JSON data"]);
            return;
        }
        
        // Check if task exists in the data
        if(!isset($data['task']) || empty($data['task'])) {
            header('HTTP/1.1 400 Bad Request');
            echo json_encode(["message" => "Task content is required"]);
            return;
        }
        
        $this->taskModel->task = $data['task'];
        $result = $this->taskModel->create(); 
        if($result){
            echo json_encode(["task" => $data["task"]]);
        }else{
            echo json_encode(["message" => "Task not added"]);
        }
    }
    
    public function updateTask($id){
        $jsonData = file_get_contents("php://input");
        
        // Check if input data exists
        if(empty($jsonData)) {
            header('HTTP/1.1 400 Bad Request');
            echo json_encode([
                "status" => "error",
                "message" => "No data provided"
            ]);
            return;
        }
        
        $data = json_decode($jsonData, true);
        
        // Check if data is properly decoded and is_completed exists
        if ($data === null || !isset($data['is_completed'])) {
            header('HTTP/1.1 400 Bad Request');
            echo json_encode([
                "status" => "error",
                "message" => "Invalid or missing completion status"
            ]);
            return;
        }
        
        $this->taskModel->id = $id;
        $result = $this->taskModel->update($data['is_completed']);
        if($result){
            echo json_encode(["id" => $id, "is_completed" => $data["is_completed"]]);
        } else {
            echo json_encode(["message" => "Task not updated"]);
        }
    }
    
    public function deleteTask($id){
        $this->taskModel->id = $id;
        $result = $this->taskModel->delete();
        if($result){
            echo json_encode([
                "status" => "success",
                "message" => "Task deleted successfully",
                "id" => $id
            ]);
        } else {
            echo json_encode([
                "status" => "error",
                "message" => "Failed to delete task"
            ]);
        }
    }
    
    public function index(){
        $tasks = $this->taskModel->read();
        if($tasks->num_rows == 0){
            echo json_encode(["message" => "No tasks found"]);
        } else {
            $data = $tasks->fetch_all(MYSQLI_ASSOC);
            $jsonData = json_encode($data);
            echo $jsonData;
        }
    }
}