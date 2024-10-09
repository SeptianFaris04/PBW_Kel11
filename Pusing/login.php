<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="asset/login.css"> <!-- Menyambungkan CSS -->
</head>
<body>
    <div class="login-container">
        <h1>Login</h1>
        <form action="index.php?action=login" method="POST">
            <label for="username">Username:</label><br>
            <input type="text" name="username" required><br><br>

            <label for="password">Password:</label><br>
            <input type="password" name="password" required><br><br>

            <input type="submit" value="Login" class="button">
        </form>
    </div>
</body>
</html>
