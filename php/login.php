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
    <title>Login</title>
</head>
<body>
    <form method="POST" action="login.php">
        <label>Username:</label>
        <input type="text" name="username" required><br>
        <label>Password:</label>
        <input type="password" name="password" required><br>
        <button type="submit">Login</button>
    </form>
</body>
</html>
