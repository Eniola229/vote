<?php
include "dbh.classes.php";

class Users extends Dbh
{
    private $pdo;

    // Constructor receives an existing PDO instance
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getUsers() {
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM candidates ORDER BY created_at DESC");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Handle exception
            echo "Error: " . $e->getMessage();
            return [];
        }
    }
}

try {
    // Establish a database connection
    $pdo = new PDO("mysql:host=localhost;dbname=rectem", 'root', '', [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, 
    ]);

    // Create an instance of the user class
    $viewUser = new Users($pdo);

    // Retrieve users
    $users = $viewUser->getUsers();
} catch (PDOException $e) {
    // Handle any connection errors
    echo "Connection failed: " . $e->getMessage();
}
