<?php
include_once dirname(__DIR__) . '/config/database.php';
include_once dirname(__DIR__) . '/models/Task.php';

class TaskController {
    private $db;
    private $task;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->task = new Task($this->db);
    }
    public function taskDone($user_id) {

        $data = json_decode(file_get_contents("php://input"));

         if (!empty($user_id)) {
            if ($this->task->taskDone($user_id)) {
                echo json_encode(array("message" => "Task was done."));
            } else {
                echo json_encode(array("message" => "Unable to set status task."));
            }
        } else {
            echo json_encode(array("message" => "Incomplete data."));
        }
    }
    public function read($user_id) {
        
        $stmt = $this->task->read($user_id);
        $tasks = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            $task_item = array(
                "id" => $taskid,
                "name" => $name,
                "description" => $description,
                "start_date" => $start_date,
                "end_date" => $end_date,
                "created_at" => $created_at,
                "updated_at" => $updated_at,
                "done_date" => $done_date,
                "deleted_at" => $deleted_at,
                "user_id" => $user_id
            );
            array_push($tasks, $task_item);
        }
        echo json_encode($tasks);
    }

    public function create() {
        $data = json_decode(file_get_contents("php://input"));

        if (!empty($data->name) && !empty($data->description) && !empty($data->start_date) && !empty($data->end_date) && !empty($data->user_id)) {
            $this->task->name = $data->name;
            $this->task->description = $data->description;
            $this->task->start_date = $data->start_date;
            $this->task->end_date = $data->end_date;
            $this->task->created_at = date('Y-m-d H:i:s');
            $this->task->user_id = $data->user_id;

            if ($this->task->create()) {
                echo json_encode(array("message" => "Task was created."));
            } else {
                echo json_encode(array("message" => "Unable to create task."));
            }
        } else {
            echo json_encode(array("message" => "Incomplete data."));
        }
    }

    public function update() {
        $data = json_decode(file_get_contents("php://input"));

        if (!empty($data->id) && (!empty($data->name) || !empty($data->description) || !empty($data->start_date) || !empty($data->end_date))) {
            $this->task->id = $data->id;
            if (!empty($data->name)) $this->task->name = $data->name;
            if (!empty($data->description)) $this->task->description = $data->description;
            if (!empty($data->start_date)) $this->task->start_date = $data->start_date;
            if (!empty($data->end_date)) $this->task->end_date = $data->end_date;
            $this->task->updated_at = date('Y-m-d H:i:s');
            if (!empty($data->user_id)) $this->task->user_id = $data->user_id;

            if ($this->task->update()) {
                echo json_encode(array("message" => "Task was updated."));
            } else {
                echo json_encode(array("message" => "Unable to update task."));
            }
        } else {
            echo json_encode(array("message" => "Incomplete data."));
        }
    }

    public function delete() {
        $data = json_decode(file_get_contents("php://input"));

        if (!empty($data->id)) {
            $this->task->id = $data->id;

            if ($this->task->delete()) {
                echo json_encode(array("message" => "Task was deleted."));
            } else {
                echo json_encode(array("message" => "Unable to delete task."));
            }
        } else {
            echo json_encode(array("message" => "Incomplete data."));
        }
    }
}
?>
