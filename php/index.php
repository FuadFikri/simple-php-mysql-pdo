<?php
session_start();


if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Index</title>
</head>
<body>
   
    <!-- Isi konten dashboard Admin di sini -->
</body>
</html>
