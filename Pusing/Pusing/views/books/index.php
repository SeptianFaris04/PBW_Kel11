<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="asset/index.css">
</head>
<body>

    <h2>Halaman Admin</h2>

    <h5>Daftar Buku</h5>

    <table border="1">
        <tr>
            <th>ID</th>
            <th>Judul</th>
            <th>Penulis</th>
            <th>Jumlah</th>
            <th>Aksi</th>
        </tr>
        <a href="?action=create">Tambah Buku</a>
        <?php while ($row = $books->fetch(PDO::FETCH_ASSOC)) : ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= $row['title'] ?></td>
                <td><?= $row['author'] ?></td>
                <td><?= $row['quantity'] ?></td>
                <td>
                    <a href="?action=update&id=<?= $row['id'] ?>">Edit |</a>
                    <a href="?action=delete&id=<?= $row['id'] ?>">Hapus</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
    <a href="index.php?action=logout">Logout</a>
</body>
</html>
