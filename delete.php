<?php
include 'koneksi.php';

$member_id = $_GET['member_id'];
mysqli_query($koneksi, "DELETE FROM member WHERE member_id ='$member_id'");
header("Location: index.php");

$koneksi->close();
