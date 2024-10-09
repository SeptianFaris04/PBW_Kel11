<?php
class LoginController{
    private $user;

    public function __construct($db) {
        $this->user = new User($db);
    }

    public function login() {
        if ($_POST) {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $user = $this->user->findUserByUsername($username);

            if ($user && $password === $user['password']) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['role'] = $user['role'];

                if ($user['role'] === 'admin') {
                    header("Location: index.php?action=admin_dashboard");
                } else {
                    header("Location: index.php?action=user_dashboard");
                }
            } else {
                echo "Invalid username or password!";
            }
        }
        include "login.php";
    }

    public function logout() {
        session_start();
        session_unset();
        session_destroy();
        header("Location: login.php");
    }

}