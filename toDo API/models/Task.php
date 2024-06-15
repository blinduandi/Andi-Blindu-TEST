<?php
class Task {
    private $conn;
    private $table_name = "tasks";

    public $id;
    public $name;
    public $description;
    public $start_date;
    public $end_date;
    public $done_date;
    public $created_at;
    public $updated_at;
    public $deleted_at;
    public $user_id;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function read($user_id) {
        $query = "SELECT taskid, name, description, start_date, end_date,done_date, created_at, updated_at, deleted_at, user_id 
        FROM " . $this->table_name . " 
        WHERE user_id = :user_id";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);

        $stmt->execute();
        return $stmt;
    }
    
    public function readOne() {
        $query = "SELECT taskid, name, description, start_date, end_date, created_at, updated_at, deleted_at, user_id FROM " . $this->table_name . " WHERE taskid = ? LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $this->id = $row['taskid'];
            $this->name = $row['name'];
            $this->description = $row['description'];
            $this->start_date = $row['start_date'];
            $this->end_date = $row['end_date'];
            $this->created_at = $row['created_at'];
            $this->updated_at = $row['updated_at'];
            $this->deleted_at = $row['deleted_at'];
            $this->user_id = $row['user_id'];
        }
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . " SET name=:name, description=:description, start_date=:start_date, end_date=:end_date, created_at=:created_at, user_id=:user_id";
        $stmt = $this->conn->prepare($query);

        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->description = htmlspecialchars(strip_tags($this->description));
        $this->start_date = htmlspecialchars(strip_tags($this->start_date));
        $this->end_date = htmlspecialchars(strip_tags($this->end_date));
        $this->created_at = htmlspecialchars(strip_tags($this->created_at));
        $this->user_id = htmlspecialchars(strip_tags($this->user_id));

        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":description", $this->description);
        $stmt->bindParam(":start_date", $this->start_date);
        $stmt->bindParam(":end_date", $this->end_date);
        $stmt->bindParam(":created_at", $this->created_at);
        $stmt->bindParam(":user_id", $this->user_id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function taskDone($user_id) {
        $query = "UPDATE " . $this->table_name . " SET done_date = NOW() WHERE taskid = :id";
        $stmt = $this->conn->prepare($query);
       
      //  $this->id = htmlspecialchars(strip_tags($user_id));
    
        $stmt->bindParam(':id', $user_id);
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
    

    public function update() {
        $query = "UPDATE " . $this->table_name . " SET name = :name, description = :description, start_date = :start_date, end_date = :end_date, updated_at = :updated_at, user_id = :user_id WHERE taskid = :id";
        $stmt = $this->conn->prepare($query);

        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->description = htmlspecialchars(strip_tags($this->description));
        $this->start_date = htmlspecialchars(strip_tags($this->start_date));
        $this->end_date = htmlspecialchars(strip_tags($this->end_date));
        $this->updated_at = htmlspecialchars(strip_tags($this->updated_at));
        $this->user_id = htmlspecialchars(strip_tags($this->user_id));
        $this->id = htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':description', $this->description);
        $stmt->bindParam(':start_date', $this->start_date);
        $stmt->bindParam(':end_date', $this->end_date);
        $stmt->bindParam(':updated_at', $this->updated_at);
        $stmt->bindParam(':user_id', $this->user_id);
        $stmt->bindParam(':id', $this->id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE taskid = :id";
        $stmt = $this->conn->prepare($query);

        $this->id = htmlspecialchars(strip_tags($this->id));
        $stmt->bindParam(':id', $this->id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}
?>
