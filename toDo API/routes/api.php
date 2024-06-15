
<?php
include_once dirname(__DIR__) . '/controllers/UserController.php';
include_once dirname(__DIR__) . '/controllers/TaskController.php';

$userController = new UserController();
$taskController = new TaskController();

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $data = json_decode(file_get_contents("php://input"));
    
    echo json_encode(array("message" =>isset($_GET['entity'])));
    if (isset($_GET['entity']) && $_GET['entity'] === 'user') {
        $userController->read();
    } elseif (isset($_GET['entity']) && $_GET['entity'] === 'task') {
        $taskController->read($user_id);
    } 
} else {
    
    $data = json_decode(file_get_contents("php://input"));
    $entity = isset($data->entity) ? $data->entity : null;
    $user_id = isset($data->taskid) ? $data->taskid: 1;
    $id = isset($data->id) ? $data->id: 1;
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $entity = isset($data->entity) ? $data->entity : null;

        if ($entity === 'user') {
            $userController->create();
        } elseif ($entity === 'task') {
            $taskController->create();
        } elseif ($entity === 'login') {
            $userController->login();
        }
        elseif ($entity === 'taskDone') {
            $taskController->taskDone($user_id);
        }
        elseif ($entity === 'taskSelect') {
            $taskController->read($id);
        }
    } elseif ($_SERVER['REQUEST_METHOD'] === 'PUT') {
        if ($entity === 'user') {
            $userController->update();
        } elseif ($entity === 'task') {
            $taskController->update();
        }
    } elseif ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
        if ($entity === 'user') {
            $userController->delete();
        } elseif ($entity === 'task') {
            $taskController->delete();
        }
    }
}
?>
