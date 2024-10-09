<?php
session_start();
require_once 'config/config.php';
require_once 'controllers/BookController.php';
require_once 'controllers/UserController.php';
require_once 'controllers/LoginController.php';

$database = new Database();
$db = $database->getConnection();

$bookController = new BookController($db);
$userController = new UserController($db);
$loginController = new LoginController($db);

if (!isset($_SESSION['user_id'])) {
    $loginController->login();
    exit;
}

$role = $_SESSION['role'];

if (isset($_GET['action'])) {
    switch ($_GET['action']) {
        case 'admin_dashboard':
            if ($role === 'admin') {
                $bookController->index();
            } else {
                echo "Access Denied!";
            }
            break;
        case 'user_dashboard':
            if ($role === 'user') {
                $userController->index();
            } else {
                echo "Access Denied!";
            }
            break;
        case 'borrow':
            $userController = new $userController($db);
            $userController->borrowBook($_GET['book_id']);
            break;
        case 'return':
            $userController = new $userController($db);
            $userController->returnBook($_GET['book_id']);
            break;
        case 'logout':
            $loginController->logout();
            break;
        case 'create':
            $bookController->create();
            break;
        case 'update':
            $bookController->update($_GET['id']);
            break;
        case 'delete':
            $bookController->delete($_GET['id']);
            break;
        default:
            $loginController->login();
            break;
    }
} else {
    if ($role === 'admin') {
        header("Location: index.php?action=admin_dashboard");
    } else {
        header("Location: index.php?action=user_dashboard");
    }
}