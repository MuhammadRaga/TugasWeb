<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "dbperpus";

$koneksi = mysqli_connect($servername, $username, $password, $database);

if (!$koneksi) {
    die("Koneksi Gagal: " .mysqli_connect_error());
  }
  echo "Koneksi sukses";







?>