<?php
class Book {
    private $conn;
    private $table = "books";

    public $id;
    public $title;
    public $author;
    public $quantity;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Create
    public function create() {
        $query = "INSERT INTO " . $this->table . " SET title=:title, author=:author, quantity=:quantity";
        $stmt = $this->conn->prepare($query);

        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->author = htmlspecialchars(strip_tags($this->author));
        $this->quantity = htmlspecialchars(strip_tags($this->quantity));

        $stmt->bindParam(":title", $this->title);
        $stmt->bindParam(":author", $this->author);
        $stmt->bindParam(":quantity", $this->quantity);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Read
    public function readAll() {
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Update
    public function update() {
        $query = "UPDATE " . $this->table . "SET title = :title, author = :author, quantity = :quantity WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->author = htmlspecialchars(strip_tags($this->author));
        $this->quantity = htmlspecialchars(strip_tags($this->quantity));
        $this->id = htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':author', $this->author);
        $stmt->bindParam(':quantity', $this->quantity);
        $stmt->bindParam(':id', $this->id);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Delete
    public function delete() {
        $query = "DELETE FROM " . $this->table . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);

        $this->id = htmlspecialchars(strip_tags($this->id));
        $stmt->bindParam(1, $this->id);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function increaseQuantity($id) {
        $query = "UPDATE " . $this->table . " SET quantity = quantity + 1 WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function decreaseQuantity($id) {
        $query = "UPDATE " . $this->table . " SET quantity = GREATEST(quantity - 1, 0) WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}