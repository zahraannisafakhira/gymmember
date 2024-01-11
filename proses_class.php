<?php
include 'koneksi.php';

$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // $member_id = mysqli_real_escape_string($koneksi, $_POST['member_id']);
    $class_name = mysqli_real_escape_string($koneksi, $_POST['class_name']);
    $price = mysqli_real_escape_string($koneksi, $_POST['price']);
    // $email = mysqli_real_escape_string($koneksi, $_POST['email']);
    // $class_name = mysqli_real_escape_string($koneksi, $_POST['class_name']);
    // $payment_status = mysqli_real_escape_string($koneksi, $_POST['payment_status']);
    // $jenis_barang = mysqli_real_escape_string($koneksi, $_POST['jenis_barang']);
    // $nama_barang = mysqli_real_escape_string($koneksi, $_POST['nama_barang']);
    // $jumlah = mysqli_real_escape_string($koneksi, $_POST['jumlah']);
    // $harga = mysqli_real_escape_string($koneksi, $_POST['harga']);

    // if (empty($member_id)) {
    //     $errors[] = "ID member tidak boleh kosong.";
    // }
    // elseif (!ctype_alnum($id_pembeli)) {
    //     $errors[] = "ID pembeli hanya boleh berisi karakter alfanumerik.";
    // }

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

    // if (empty($jenis_barang)) {
    //     $errors[] = "Jenis barang tidak boleh kosong.";
    // }

    // if (empty($nama_barang)) {
    //     $errors[] = "Nama barang tidak boleh kosong.";
    // }

    // if (empty($jumlah)) {
    //     $errors[] = "Jumlah tidak boleh kosong.";
    // }

    // if (empty($harga)) {
    //     $errors[] = "Harga tidak boleh kosong.";
    // }

    if (empty($errors)) {
        $sql = "INSERT INTO class (class_name, price) 
                VALUES ('$class_name', '$price')";

        if ($koneksi->query($sql) === TRUE) {
            header("Location: index.php");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $koneksi->error;
        }
    }
}
// $selectQuery = "SELECT member_name FROM member";

// $result = $koneksi->query($selectQuery);
// if ($result) {
//     echo '<table border="1">
//                 <tr>
//                     <th>Name</th>
//                 </tr>';

//     while ($row = $result->fetch_assoc()) {
//         echo '<tr>
//                         <td>' . $row["member_name"] . '</td>
//                     </tr>';
//     }

//     echo '</table>';
// } else {
//     echo "Error: " . $koneksi->error;
// }

$koneksi->close();
