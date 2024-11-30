<?php
session_start();
if ($_SESSION['role'] != 'public') {
  header("Location: login.php");
  exit();
}

include '../config/database.php';
$id_user = $_SESSION['id_user'];
$sql = "SELECT * FROM Pengaduan WHERE id_user = :id_user";
$stmt = $pdo->prepare($sql);
$stmt->execute(['id_user' => $id_user]);
$pengaduan = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Pengaduan</title>
    <!-- <link rel="stylesheet" href="user_dashboard.css"> -->

    <style>

body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f9;
    margin: 0;
    padding: 0;
    text-align: center;
}

h1 {
    color: #333;
    margin-top: 20px;
}

a {
    display: inline-block;
    margin: 20px 0;
    text-decoration: none;
    color: #fff;
    background-color: #007BFF;
    padding: 10px 20px;
    border-radius: 5px;
    transition: background-color 0.3s;
}

a:hover {
    background-color: #0056b3;
}

table {
    margin: 20px auto;
    width: 80%;
    border-collapse: collapse;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    background: #fff;
}

th, td {
    padding: 15px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}

th {
    background-color: #007BFF;
    color: #fff;
    font-weight: bold;
}

tr:hover {
    background-color: #f1f1f1;
}

td {
    color: #333;
}



    </style>

</head>
<body>
    <h1>Daftar Pengaduan Saya</h1>
    <a href="form_pengaduan.php">Tambah Pengaduan</a>
    <table>
        <tr>
            <th>Judul</th>
            <th>Status</th>
            <th>Tanggal</th>
        </tr>
        <?php foreach ($pengaduan as $p) { ?>
        <tr>
            <td><?= $p['judul_pengaduan']; ?></td>
            <td><?= $p['status_pengaduan']; ?></td>
            <td><?= $p['tanggal_pengaduan']; ?></td>
        </tr>
        <?php } ?>
    </table>
    <a href="logout.php">Logout</a>
</body>
</html>
