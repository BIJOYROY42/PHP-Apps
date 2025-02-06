<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Todo List</h1>
    <form method="POST">
        <input type="text" name="task" placeholder="Enter a new task">
        <button type="submit" name = "add_task">Add Task</button>
    </form>


    <?php while($task = $tasks->fetch_assoc()): ?>
        <div>
           
            <p><?php echo $task['task']; ?></p>
            <?php if(!$task['is_completed']): ?>
                <form method="POST" style="display:inline">
                    <input type="hidden" name="id" value="<?php echo $task['id']; ?>">
                    <button type="submit"name="complete_task">Complete</button>
                </form>
            <?php else: ?>
                <form method="POST" style="display:inline">
                    <input type="hidden" name="id" value="<?php echo $task['id']; ?>">
                    <button type="submit"name="undo_complete_task">Undo</button>
                </form>
            <?php endif; ?>

            <form action=""></form>
        </div>
    
    <?php endwhile; ?>
    
</body>
</html>