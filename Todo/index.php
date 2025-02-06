<?php
include "controller/TaskController.php";

$controller = new TaskController();

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    if(isset($_POST['add_task'])){
        $controller->addTask($_POST['task']);
        
    }elseif(isset($_POST['complete_task'])){
        $controller->updateTask($_POST['id'],1);

    }elseif(isset($_POST['undo_complete_task'])){
        $controller->updateTask($_POST['id'],0);

    }
    

}else{
    $controller-> index();
}