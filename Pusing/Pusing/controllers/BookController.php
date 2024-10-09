<?php
require_once 'models/Book.php';
class BookController {
    private $db;
    private $conn;
    private $book;

    public function __construct($db) {
        $this->conn = $db;
        $this->book = new Book($db);
    }

    public function index() {
        $books = $this->book->readAll();
        include "views/books/index.php";
    }

    public function create() {
        if ($_POST) {
            $this->book->title = $_POST['title'];
            $this->book->author = $_POST['author'];
            $this->book->quantity = $_POST['quantity'];
            if ($this->book->create()) {
                header("Location: index.php");
            }
        }
        include "views/books/create.php";
    }

    public function update($id) {
        if ($_POST) {
            $this->book->id = $id;
            $this->book->title = $_POST['title'];
            $this->book->author = $_POST['author'];
            $this->book->quantity = $_POST['quantity'];
            if ($this->book->update()) {
                header("Location: index.php");
            }
        }
        include "views/books/update.php";
    }

    public function delete($id) {
        $this->book->id = $id;
        if ($this->book->delete()) {
            header("Location: index.php");
        }
    }
}