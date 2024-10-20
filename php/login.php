<?php
session_start();
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Cek apakah username dan password benar
    $stmt = $pdo->prepare("SELECT * FROM pengguna p 
                            left join hakakses h on p.IdAkses = h.IdAkses
                            WHERE NamaPengguna = :username");
    $stmt->execute(['username' => $username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['Password'])) {
        // Simpan sesi
        $_SESSION['user_id'] = $user['NamaPengguna'];
        $_SESSION['role'] = $user['NamaAkses'];

        // Redirect berdasarkan role
        switch ($user['NamaAkses']) {
            case 'ADMIN':
                header('Location: admin.php');
                break;
            case 'STAFF_PENJUALAN':
                header('Location: staff_penjualan.php');
                break;
            case 'STAFF_PEMBELIAN':
                header('Location: staff_pembelian.php');
                break;
        }
        exit();
    } else {
        echo "Username atau password salah.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- Link CSS Bootstrap -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .login-container {
            max-width: 400px;
            margin: auto;
            padding: 20px;
            border: 1px solid #ced4da;
            border-radius: 5px;
            background-color: #ffffff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 100px;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2 class="text-center">Login</h2>
        <form method="POST" action="login.php">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Login</button>
        </form>
    </div>

    <!-- Script JS Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
