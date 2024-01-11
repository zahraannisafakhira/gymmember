<?php
include 'koneksi.php';

$class_id = $_GET['class_id'];
mysqli_query($koneksi, "DELETE FROM class WHERE class_id ='$class_id'");
header("Location: index.php");

$koneksi->close();
