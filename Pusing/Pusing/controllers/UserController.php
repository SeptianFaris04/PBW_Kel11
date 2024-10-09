<?php
require 'models/User.php';
class UserController {
    private $conn;
    private $user;

    public function __construct($db) {
        $this->conn = $db;
        $this->user = new User($db);
    }

    public function index() {
        $books = $this->user->readAll();
        include "views/users/index_user.php";
    }

    public function borrowBook($book_id) {
        $this->user->id = $_SESSION['user_id'];
        if ($this->user->borrowBook($book_id)) {
            echo "<script type='text/javascript'>alert('Peminjaman Buku Berhasil!');</script>";
            header("views/users/index_user.php");
        } else {
            echo "<script type='text/javascript'>alert('Peminjaman Buku Gagal!');</script>";
        }
    }

    public function returnBook($book_id) {
        $this->user->id = $_SESSION['user_id'];
        if ($this->user->returnBook($book_id)) {
            echo "<script type='text/javascript'>alert('Pngembalian Buku Berhasil!');</script>";
        } else {
            echo "<script type='text/javascript'>alert('Pengembalian Buku Gagal!');</script>";
        }
    }
}