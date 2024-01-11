<?php
include 'koneksi.php';

$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mengambil data dari formulir
    $class_id = mysqli_real_escape_string($koneksi, $_POST['class_id']);
    $class_name = mysqli_real_escape_string($koneksi, $_POST['class_name']);
    $price = mysqli_real_escape_string($koneksi, $_POST['price']);
    // $email = mysqli_real_escape_string($koneksi, $_POST['email']);
    // $class_name = mysqli_real_escape_string($koneksi, $_POST['class_name']);
    // $payment_status = mysqli_real_escape_string($koneksi, $_POST['payment_status']);

    if (empty($class_name)) {
        $errors[] = "Nama tidak boleh kosong.";
    } elseif (!preg_match('/^[a-zA-Z\s]{1,30}$/', $class_name)) {
        $errors[] = "Nama tidak boleh mengandung karakter spesial atau angka, maksimal 30 karakter.";
    }

    if (empty($price)) {
        $errors[] = "Nomor HP tidak boleh kosong.";
    }

    // if (empty($email)) {
    //     $errors[] = "Email tidak boleh kosong.";
    // }

    // if (empty($payment_status)) {
    //     $errors[] = "Payment status tidak boleh kosong.";
    // }

    // $selectQuery = "SELECT class_id FROM class Where class_name = '$class_name'";

    // $result = $koneksi->query($selectQuery);

    // if ($result) {
    //     $row = $result->fetch_assoc();
    //     $class_id = $row["class_id"];
    // } else {
    //     echo "Error: " . $koneksi->error;
    // }

    // Update data di database
    $sql = "UPDATE class SET class_name='$class_name', price='$price' WHERE class_id=$class_id";


    if ($koneksi->query($sql) === TRUE) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $koneksi->error;
    }
}

$koneksi->close();
