<?php
session_start();
require 'db.php';


if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'STAFF_PEMBELIAN') {
    header('Location: login.php');
    exit();
}


$stmt = $pdo->prepare("SELECT * FROM pembelian p
join barang b on  p.idBarang = b.IdBarang
join supplier s on s.IdSupplier = p.IdSupplier");
$stmt->execute();
$pembelian = $stmt->fetchAll(PDO::FETCH_ASSOC);

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
    <div class="row justify-content-start">
        <div class="col-8"></div>
        <div class="col-4">
        <form method="POST" action="logout.php">
            <button class="btn-danger" type="submit" >log out</button>
        </form>
        </div>
        
    </div>

    <div class="container">
        <h1>Selamat datang, Staff Pembelian!</h1>
        
        <h2>Daftar Pembelian</h2>
        <table class="table table-bordered">
            <thead class="thead-light">
                <tr>
                    <th>Id Pembelian</th>
                    <th>Barang</th>
                    <th>Jumlah Pembelian</th>
                    <th>Satuan</th>
                    <th>Harga Beli</th>
                    <th>Supplier</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($pembelian as $item): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($item['IdPembelian']); ?></td>
                        <td><?php echo htmlspecialchars($item['NamaBarang']); ?></td>
                        <td><?php echo htmlspecialchars($item['JumlahPembelian']); ?></td>
                        <td><?php echo htmlspecialchars($item['Satuan']); ?></td>
                        <td><?php echo htmlspecialchars($item['HargaBeli']); ?></td>
                        <td><?php echo htmlspecialchars($item['NamaSupplier']); ?></td>
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