<?php
// Pastikan session hanya start sekali
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Koneksi database
include 'koneksi.php';