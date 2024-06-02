<?php

class Database {
    private $host = "localhost";
    private $db_name = "rectem";
    private $username = "root";
    private $password = "";
    public $conn;

    public function getConnection() {
        $this->conn = null;
        try {
            $this->conn = new mysqli($this->host, $this->username, $this->password, $this->db_name);
            if ($this->conn->connect_error) {
                throw new Exception("Connection failed: " . $this->conn->connect_error);
            }
        } catch (Exception $e) {
            echo "Connection error: " . $e->getMessage();
        }

        return $this->conn;
    }
}

class User {
    private $conn;
    private $table_name = "Feedback";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function search($first_name) {
        $sql = $this->conn->prepare("SELECT * FROM " . $this->table_name . " WHERE name LIKE ?");
        $like_first_name = "%$first_name%";
        $sql->bind_param("s", $like_first_name);
        if (!$sql->execute()) {
            // Handle SQL execution error
            echo "Error executing query: " . $this->conn->error;
            return false;
        }
        return $sql->get_result();
    }
}

// Create database connection
$database = new Database();
$db = $database->getConnection();

// Create User object
$user = new User($db);

// Process search request
if (isset($_GET['first_name'])) {
    $first_name = $_GET['first_name'];
    $result = $user->search($first_name);

    if ($result && $result->num_rows > 0) {
        echo '
        <div class="container mt-5">
            <h5 class="mb-4">Result </h5>
            <table class="table">
                <thead>
                    <tr>
                         <th scope="col">#</th>
                          <th scope="col">Full Name</th>
                          <th scope="col">Email</th>
                          <th scope="col">Candidate</th>
                          <th scope="col">Feedback</th>
                    </tr>
                </thead>
                <tbody>';
        
        while ($row = $result->fetch_assoc()) {
            echo '
            <tr class="table-primary">
                <td>' . htmlspecialchars($row['user_id']) . '</td>
                <td>' . htmlspecialchars($row['name'])  . '</td>
                <td>' . htmlspecialchars($row['email']) . '</td>
                <td>' . htmlspecialchars($row['candidates']) . '</td>
                <td>' . htmlspecialchars($row['msg']) . '</td>
                <td>
                    <a href="viewspecificstudent.php?id=' . htmlspecialchars($row['user_id']) . '">
                        <button type="button" class="btn btn-info btn-sm">View</button>
                    </a>
                </td>
            </tr>';
                    }
        
        echo '
                </tbody>
            </table>
        </div>';
    } else {
        echo "No results found";
    }
}
?>
