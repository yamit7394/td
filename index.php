<?php 
    session_start();
    include_once('config.php');
    $editItem=array();
    $action=$_POST['action'];
    //echo $action;
    if(isset($_POST['action'])){
        $updateId=$_POST['updateList'];
        $task=$_POST['task'];
        $taskId=$_POST['taskId'];
        $updateList=array('id'=>$updateId,'task'=>$task);
        switch($action){
            case "add":
                if($task!=''){ addInTodo($task);}
                break;
            case "edit":
                $editItem=edit($taskId);
                break;
            case "delete":
                delete($taskId);
                break;
            case "update":
                update($updateList);
                break;
        }

    }
    if(isset($_POST['todoId'])){
        completed($_POST['todoId']);
    }
   // print_r($edititem);
?>
<html>
    <head>
        <title>TODO List</title>
        <link href="style.css" type="text/css" rel="stylesheet">
    </head>
    <body>
        <div class="container">
            <h2>TODO LIST</h2>
            <h3>Add Item</h3>
            <p>
                <form method="POST" action="">
                    <input id="new-task" type="text" name="task" value="<?php echo $editItem['task']; ?>">
                    <input type="hidden" name="updateList" value="<?php echo $editItem['id']; ?>">
                    <?php if(sizeof($editItem)):?>
                    <button type="submit" name="action" value="update">Update</button>
                    <?php else:?>
                    <button type="submit" name="action" value="add">Add</button>
                    <?php endif;?>
                </form>
            </p>
    
            <h3>Todo</h3>
            <ul id="incomplete-tasks">
                <?php echo displayTodo(); ?>
            </ul>
    
            <h3>Completed</h3>
            <ul id="completed-tasks">
                <?php echo displayCompleted(); ?>
                <!-- <li><input type="checkbox" checked><label>See the Doctor</label><input type="text"><button class="edit">Edit</button><button class="delete">Delete</button></li> -->
            </ul>
        </div>
    
    </body>
</html>