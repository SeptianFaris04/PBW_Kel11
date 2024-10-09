<?php
class User {
    private $conn;
    private $table = "users";

    public $id;
    public $username;
    public $password;
    public $role;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function readAll() {
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function findUserByUsername($username) {
        $query = "SELECT * FROM " . $this->table . " WHERE username = :username LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":username", $username);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function borrowBook($book_id) {
        $query = "INSERT INTO borrows (user_id, book_id, borrow_date, return_date) VALUES (:user_id, :book_id, NOW(), NULL)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":user_id", $this->id);
        $stmt->bindParam(":book_id", $book_id);

        if ($stmt->execute()) {
            $book = new Book($this->conn);
            return $book->decreaseQuantity($book_id);
        }
        return false;
    }

    public function returnBook($book_id) {
        $query = "UPDATE borrows SET return_date = NOW() WHERE user_id = :user_id AND book_id = :book_id AND return_date IS NULL";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":user_id", $this->id);
        $stmt->bindParam(":book_id", $book_id);

        if ($stmt->execute()) {
            $book = new Book($this->conn);
            return $book->increaseQuantity($book_id);
        }
        return false;
    }
}