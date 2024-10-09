<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="asset/update.css">
</head>
<body>
    <form action="" method="POST">
        <label for="title">Judul:</label><br>
        <input type="text" name="title" value="<?= $row['title'] ?>" placeholder="Input Judul" required><br><br>

        <label for="author">Penulis:</label><br>
        <input type="text" name="author" value="<?= $row['author'] ?>" placeholder="Input Penulis" required><br><br>

        <label for="quantity">Jumlah:</label><br>
        <input type="number" name="quantity" value="<?= $row['quantity'] ?>" required><br><br>

        <input type="submit" value="Simpan">
    </form>
</body>
</html>
