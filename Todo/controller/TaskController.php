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
    public function addTask($task){
        // Validate that task is not empty before saving
        if(empty(trim($task))) {
            $_SESSION["message"] = "Task cannot be empty";
            $_SESSION["message_type"] = "error";
            header("Location:".$_SERVER['PHP_SELF']);
            exit;
        }
        
        $this->taskModel->task = $task;
        $result = $this->taskModel->create(); 
        // print_r($result);
        if($result){
            $_SESSION["message"]= "Task added successfully";
            $_SESSION["message_type"] = "success";
        }else{
            $_SESSION["message"]= "Failed to add task";
            $_SESSION["message_type"] = "error";
        }
       header("Location:".$_SERVER['PHP_SELF']);
       exit;
    }
    public function updateTask($id, $is_completed){
        $this->taskModel->id = $id;
        $result = $this->taskModel->update($is_completed);
        if($result){
            $_SESSION["message"] = $is_completed ? "Task marked as complete" : "Task marked as incomplete";
            $_SESSION["message_type"] = "success";
        } else {
            $_SESSION["message"] = "Failed to update task";
            $_SESSION["message_type"] = "error";
        }
        header("Location:".$_SERVER['PHP_SELF']);
        exit;
    }
    public function deleteTask($id){
        $this->taskModel->id = $id;
        $result = $this->taskModel->delete();
        if($result){
            $_SESSION["message"] = "Task deleted successfully";
            $_SESSION["message_type"] = "success";
        } else {
            $_SESSION["message"] = "Failed to delete task";
            $_SESSION["message_type"] = "error";
        }
        header("Location:".$_SERVER['PHP_SELF']);
        exit;
    }
    public function index(){
        $tasks = $this->taskModel->read();
        // print_r($task);
        if($tasks->num_rows==0){
            // error
        }
        // show in view
        include "view/TaskView.php";
    }
}