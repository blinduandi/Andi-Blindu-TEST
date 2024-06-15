<?php
include_once dirname(__DIR__) . '/config/database.php';
include_once dirname(__DIR__) . '/models/User.php';

class UserController {
    private $db;
    private $user;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->user = new User($this->db);
    }

    public function read() {
        $stmt = $this->user->read();
        $users = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            extract($row);
            $user_item = array(
                "id" => $userid,
                "name" => $name,
                "email" => $email,
                "password" => $password,
                "created_at" => $created_at
            );
            array_push($users, $user_item);
        }
        echo json_encode(array("status" => "success", "data" => $users));
    }

    public function create() {
        $data = json_decode(file_get_contents("php://input"));

        if (!empty($data->name) && !empty($data->email) && !empty($data->password)) {
            if ($this->user->emailExists($data->email)) {
                echo json_encode(array("status" => "error", "message" => "Email already exists."));
                return;
            }

            if (strlen($data->password) < 6) {
                echo json_encode(array("status" => "error", "message" => "Password must be at least 6 characters long."));
                return;
            }
            //$this->user->id = $data->id;
            $this->user->name = $data->name;
            $this->user->email = $data->email;
            $this->user->password = $data->password; 
            $this->user->created_at = date('Y-m-d H:i:s');
            $response = $this->user->create();
            if ($response != false) {
                echo json_encode(array("status" => "success", "message" => "User was created.", "data" => $response));
            } else {
                echo json_encode(array("status" => "error", "message" => "Unable to create user."));
            }
        } else {
            echo json_encode(array("status" => "error", "message" => "Incomplete data."));
        }
    }

    public function update() {
        $data = json_decode(file_get_contents("php://input"));

        if (!empty($data->id) && (!empty($data->name) || !empty($data->email) || !empty($data->password))) {
            $this->user->id = $data->id;
            if (!empty($data->name)) $this->user->name = $data->name;
            if (!empty($data->email)) $this->user->email = $data->email;
            if (!empty($data->password)) $this->user->password = $data->password; 

            if ($this->user->update()) {
                echo json_encode(array("status" => "success", "message" => "User was updated."));
            } else {
                echo json_encode(array("status" => "error", "message" => "Unable to update user."));
            }
        } else {
            echo json_encode(array("status" => "error", "message" => "Incomplete data."));
        }
    }

    public function login() {
        $data = json_decode(file_get_contents("php://input"));

        if (!empty($data->email) && !empty($data->password)) {
            $this->user->email = $data->email;
            $this->user->password = $data->password;

            $stmt = $this->user->readOneByEmail();

            if ($stmt->rowCount() > 0) {
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                extract($row);

                if (password_verify($this->user->password, $password)) {
                    $response = array(
                        "status" => "success",
                        "message" => "Login successful",
                        "user" => array(
                            "id" => $userid,
                            "name" => $name,
                            "email" => $email,
                        )
                    );
                    echo json_encode($response);
                    return;
                }
            }

            echo json_encode(array("status" => "error", "message" => "Invalid email or password"));
        } else {
            echo json_encode(array("status" => "error", "message" => "Incomplete data"));
        }
    }

    public function delete() {
        $data = json_decode(file_get_contents("php://input"));

        if (!empty($data->id)) {
            $this->user->id = $data->id;

            if ($this->user->delete()) {
                echo json_encode(array("status" => "success", "message" => "User was deleted."));
            } else {
                echo json_encode(array("status" => "error", "message" => "Unable to delete user."));
            }
        } else {
            echo json_encode(array("status" => "error", "message" => "Incomplete data."));
        }
    }
}
?>
