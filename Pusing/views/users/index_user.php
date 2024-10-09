<?php
// Adjust the include paths based on your project structure
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../../controllers/UserController.php';
require_once __DIR__ . '/../../models/User.php';
require_once __DIR__ . '/../../models/Book.php';

$database = new Database();
$db = $database->getConnection();

$book = new Book($db);

// Handle quantity updates
if (isset($_POST['action']) && isset($_POST['book_id'])) {
    $bookId = $_POST['book_id'];
    $action = $_POST['action'];
    
    if ($action === 'increase') {
        $book->increaseQuantity($bookId);
    } elseif ($action === 'decrease') {
        $book->decreaseQuantity($bookId);
    }
}

$result = $book->readAll();
$books = $result->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Buku Peminjaman</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2>Daftar Buku Peminjaman</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Judul</th>
            <th>Penulis</th>
            <th>Quantity</th>
            <th>Action</th>
        </tr>
        <?php foreach ($books as $row): ?>
        <tr>
            <td><?php echo htmlspecialchars($row['id']); ?></td>
            <td><?php echo htmlspecialchars($row['title']); ?></td>
            <td><?php echo htmlspecialchars($row['author']); ?></td>
            <td><?php echo htmlspecialchars($row['quantity']); ?></td>
            <td>
                <form method="post" style="display: inline;">
                    <input type="hidden" name="book_id" value="<?php echo $row['id']; ?>">
                    <button type="submit" name="action" value="borrow">Pinjam</button>
                    <button type="submit" name="action" value="return">Balikin</button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
