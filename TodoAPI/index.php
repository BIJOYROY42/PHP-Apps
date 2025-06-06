<?php
include "controller/TaskController.php";

$controller = new TaskController();

$scriptName = dirname($_SERVER['SCRIPT_NAME']); 
$requestUri = str_replace($scriptName, '', $_SERVER['REQUEST_URI']); 
 
$request = explode("/", trim($requestUri, "/")); 
$requestMethod = $_SERVER['REQUEST_METHOD'];

// GET  /                ----> get all tasks
// POST /task            ----> add a new task
// PUT /task/1           ----> mark task 1 as complete
//   {"is_completed": 1}
// PUT /task/1            ----> mark task 1 as incomplete
//   {"is_completed": 0}
// DELETE /task/1         ----> delete task 1
if($_SERVER["REQUEST_METHOD"] === "GET"){
    // echo "GET";
    $controller-> index();
    // echo $_SERVER['SCRIPT_NAME'];
    // echo "\n";
    // echo $scriptName;
    // echo "\n";
    // echo $_SERVER['REQUEST_URI'];
    // echo "\n";
    // echo $requestUri;
    // echo "\n";
    // echo $request[1];

}elseif($_SERVER["REQUEST_METHOD"] === "POST"){
    // echo "POST";
    $controller->addTask();
}elseif($_SERVER["REQUEST_METHOD"] === "PUT"){
    // echo "PUT";
    $controller->updateTask($request[1]);
}elseif($_SERVER["REQUEST_METHOD"] === "DELETE"){
    // Check if task ID exists in the URL
    if(isset($request[1]) && is_numeric($request[1])) {
        $taskId = $request[1];
        $controller->deleteTask($taskId);
    } else {
        // Return error if no task ID is provided
        header('HTTP/1.1 400 Bad Request');
        echo json_encode([
            "status" => "error",
            "message" => "Task ID is required"
        ]);
    }
}else{
    echo "ELSE";
    // $controller-> index();
}
