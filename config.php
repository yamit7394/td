<?php 
    session_start();

    function addInTodo($task){
        $todoList = isset($_SESSION['todoList']) ? $_SESSION['todoList'] : array();
        $taskWitdId=array('id'=>rand(100,100000),'task'=>$task,'status'=>0);
        array_push($todoList,$taskWitdId);
        $_SESSION['todoList']=$todoList;
        //session_unset();
    }

    function displayTodo(){
        $todoList = isset($_SESSION['todoList']) ? $_SESSION['todoList'] : array();
        $task='';
        if(sizeof($todoList)){
            //print_r($todoList);
            foreach($todoList as $key => $value){
                if($value['status']==0){
                    $task .= '<form method="POST" action="">
                                    <li><input type="checkbox" name="completeTask" value="'.$value['id'].'" onchange="form.submit();"><label>'.$value['task'].'</label>
                                        <input type=hidden name="taskId" value="'.$value['id'].'">
                                        <input type=hidden name="todoId" value="'.$value['id'].'">
                                        <button class="edit" type="submit" name="action" value="edit">Edit</button>
                                        <button type="submit" name="action" value="delete" class="delete">Delete</button></li>
                                </form>';
                }
               
            }
        }
        return $task;
        
    }

    function delete($taskId){
        foreach($_SESSION['todoList'] as $key => $value){
            if($taskId == $value['id']){
                unset($_SESSION['todoList'][$key]);
                break;
            }
        }
    }

    function edit($taskId){
        $todoList = isset($_SESSION['todoList']) ? $_SESSION['todoList'] : array();
        foreach($todoList as $key => $value){
            if($taskId == $value['id']){
                return $value;
            }
        }
    }

    function update($updateList){
        $todoList = isset($_SESSION['todoList']) ? $_SESSION['todoList'] : array();
        foreach($todoList as $key => $value){
            if($updateList['id'] == $value['id']){
                $todoList[$key]['task']=$updateList['task'];
                $_SESSION['todoList']=$todoList;
            }
        }
    }

    function completed($id){
        $todoList = isset($_SESSION['todoList']) ? $_SESSION['todoList'] : array();
        foreach($todoList as $key => $value){
            if($id == $value['id']){
                $todoList[$key]['status']=1;
                $_SESSION['todoList']=$todoList;
            }
        }
    }
    function displayCompleted(){
        $todoList = isset($_SESSION['todoList']) ? $_SESSION['todoList'] : array();
        $task='';
        if(sizeof($todoList)){
            //print_r($todoList);
            foreach($todoList as $key => $value){
                if($value['status']==1){
                    $task .= '<form method="POST" action="">
                                    <li><input type="checkbox" checked><label>'.$value['task'].'</label>
                                        <input type=hidden name="taskId" value="'.$value['id'].'">
                                        <button class="edit" type="submit" name="action" value="edit">Edit</button>
                                        <button type="submit" name="action" value="delete" class="delete">Delete</button></li>
                                </form>';
                }
               
            }
        }
        return $task;
    }
?>