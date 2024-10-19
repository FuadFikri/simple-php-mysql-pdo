<?php
session_start();
require 'db.php';


if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'STAFF_PENJUALAN') {
    header('Location: login.php');
    exit();
}


$stmt2 = $pdo->prepare("SELECT * FROM penjualan p
join barang b on  p.idBarang = b.IdBarang
join pelanggan c on c.IdPelanggan = p.IdPelanggan");
$stmt2->execute();
$penjualan = $stmt2->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Link CSS Bootstrap -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            padding: 20px;
        }
        h1 {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Selamat datang, Staff Penjualan!</h1>
        
      

        <h2>Daftar Penjualan</h2>
        <table class="table table-bordered">
            <thead class="thead-light">
                <tr>
                    <th>Id Penjualan</th>
                    <th>Barang</th>
                    <th>Jumlah Penjualan</th>
                    <th>Satuan</th>
                    <th>Harga Jual</th>
                    <th>Pelanggan</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($penjualan as $item): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($item['IdPenjualan']); ?></td>
                        <td><?php echo htmlspecialchars($item['NamaBarang']); ?></td>
                        <td><?php echo htmlspecialchars($item['JumlahPenjualan']); ?></td>
                        <td><?php echo htmlspecialchars($item['Satuan']); ?></td>
                        <td><?php echo htmlspecialchars($item['HargaJual']); ?></td>
                        <td><?php echo htmlspecialchars($item['NamaPelanggan']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Script JS Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>