<?php
$_HOST = "localhost";
$_USERNAME = "root";
$_DATABASE = "db_bisnis";
$_PASSWORD = "password123";
// $_PASSWORD = "";

$koneksi = mysqli_connect($_HOST, $_USERNAME, $_PASSWORD, $_DATABASE);
if (!$koneksi) {
    echo "Koneksi gagal";
}