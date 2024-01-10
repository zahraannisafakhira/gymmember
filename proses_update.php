<?php
include 'koneksi.php';

$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mengambil data dari formulir
    $member_id = mysqli_real_escape_string($koneksi, $_POST['member_id']);
    $member_name = mysqli_real_escape_string($koneksi, $_POST['name']);
    $phone_number = mysqli_real_escape_string($koneksi, $_POST['phone_number']);
    $email = mysqli_real_escape_string($koneksi, $_POST['email']);
    $class_name = mysqli_real_escape_string($koneksi, $_POST['class_name']);
    $payment_status = mysqli_real_escape_string($koneksi, $_POST['payment_status']);

    if (empty($member_name)) {
        $errors[] = "Nama tidak boleh kosong.";
    } elseif (!preg_match('/^[a-zA-Z\s]{1,30}$/', $member_name)) {
        $errors[] = "Nama tidak boleh mengandung karakter spesial atau angka, maksimal 30 karakter.";
    }

    if (empty($phone_number)) {
        $errors[] = "Nomor HP tidak boleh kosong.";
    }
    //  hai
    //hai juga
    if (empty($email)) {
        $errors[] = "Email tidak boleh kosong.";
    }

    if (empty($payment_status)) {
        $errors[] = "Payment status tidak boleh kosong.";
    }

    $selectQuery = "SELECT class_id FROM class Where class_name = '$class_name'";

    $result = $koneksi->query($selectQuery);

    if ($result) {
        $row = $result->fetch_assoc();
        $class_id = $row["class_id"];
    } else {
        echo "Error: " . $koneksi->error;
    }

    // Update data di database
    $sql = "UPDATE member SET member_name='$member_name', phone_number='$phone_number', email='$email', class_id='$class_id', payment_status='$payment_status' WHERE member_id=$member_id";


    if ($koneksi->query($sql) === TRUE) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $koneksi->error;
    }
}

$koneksi->close();
