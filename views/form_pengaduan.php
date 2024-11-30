<?php
session_start();
if ($_SESSION['role'] != 'public') {
  header("Location: login.php"); 
  exit();
}

include '../config/database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $id_user = $_SESSION['id_user']; 
  $judul_pengaduan = $_POST['judul_pengaduan'];
  $deskripsi = $_POST['deskripsi'];

  $sql = "INSERT INTO Pengaduan (id_user, judul_pengaduan, deskripsi) VALUES (:id_user, :judul_pengaduan, :deskripsi)";
  $stmt = $pdo->prepare($sql);
  $stmt->execute([
    'id_user' => $id_user,
    'judul_pengaduan' => $judul_pengaduan,
    'deskripsi' => $deskripsi
  ]);

  header("Location: user_dashboard.php");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Form Pengaduan</title>
  <!-- <link rel="stylesheet" href="style.css"> -->

  <style>

body {
    font-family: Arial, sans-serif;
    background-color: #f9fafb;
    color: #333;
    text-align: center;
    margin: 0;
    padding: 0;
}

h1 {
    margin-top: 20px;
    color: #333;
}

form {
    max-width: 500px;
    margin: 30px auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

label {
    display: block;
    margin-bottom: 8px;
    font-weight: bold;
    color: #555;
    text-align: left;
}

.input {
    width: 100%;
    padding: 12px;
    margin-bottom: 20px;
    border: 1px solid #ddd;
    border-radius: 8px;
    font-size: 14px;
    outline: none;
    transition: border-color 0.3s;
}

.input:focus {
    border-color: #007bff;
    box-shadow: 0 0 4px rgba(0, 123, 255, 0.3);
}

button {
    display: inline-block;
    width: 100%;
    padding: 12px;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 8px;
    font-size: 16px;
    font-weight: bold;
    cursor: pointer;
    transition: background-color 0.3s, transform 0.2s;
    position: relative;
    overflow: hidden;
}

button:hover {
    background-color: #0056b3;
    transform: translateY(-2px);
}

button:active {
    transform: translateY(0);
}

button .circle1,
button .circle2,
button .circle3,
button .circle4,
button .circle5 {
    position: absolute;
    border-radius: 50%;
    background-color: rgba(255, 255, 255, 0.3);
    animation: ripple 1.5s infinite;
}

button .circle1 {
    top: 10%;
    left: 15%;
    width: 8px;
    height: 8px;
    animation-delay: 0s;
}

button .circle2 {
    top: 50%;
    right: 15%;
    width: 10px;
    height: 10px;
    animation-delay: 0.3s;
}

button .circle3 {
    bottom: 10%;
    left: 20%;
    width: 12px;
    height: 12px;
    animation-delay: 0.6s;
}

button .circle4 {
    bottom: 30%;
    right: 10%;
    width: 14px;
    height: 14px;
    animation-delay: 0.9s;
}

button .circle5 {
    top: 20%;
    left: 50%;
    width: 16px;
    height: 16px;
    animation-delay: 1.2s;
}

@keyframes ripple {
    0% {
        transform: scale(0);
        opacity: 1;
    }
    100% {
        transform: scale(4);
        opacity: 0;
    }
}

button .text {
    position: relative;
    z-index: 1;
}


  </style>

</head>
<body>
  <h1>Form Pengaduan Baru</h1>
  <form method="POST">
    <label for="judul_pengaduan">Judul Pengaduan</label>
    <!-- <input type="text" name="judul_pengaduan" id="judul_pengaduan" required> -->
    <input type="text" autocomplete="off" name="judul_pengaduan" id="judul_pengaduan" class="input" placeholder="Masukan Judul"><br>


    <label for="deskripsi">Deskripsi Pengaduan</label>
    <!-- <textarea name="deskripsi" id="deskripsi" required></textarea>

    <button type="submit">Kirim Pengaduan</button> -->
    <textarea id="deskripsi" name="deskripsi" required class="input" placeholder="Deskripsikan Pengaduanmu"></textarea><br>
    <button type="submit">
        <span class="circle1"></span>
        <span class="circle2"></span>
        <span class="circle3"></span>
        <span class="circle4"></span>
        <span class="circle5"></span>
        <span class="text">Kirim Pengaduan</span>
    </button>
  </form>
</body>
</html>
