<?php
$host = "localhost";
$port = "3306";
$username = "root";
$password = "";
$database = "gymmember";

$koneksi = new mysqli($host, $username, $password, $database, $port);

if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}
