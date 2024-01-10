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

$selectQuery = "SELECT member_id, member_name, phone_number, email, class_id, payment_status FROM member";

$result = $koneksi->query($selectQuery);
if ($result) {
    echo '<table border="1">
                <tr>
                    <th>Member ID</th>
                    <th>Name</th>
                    <th>Phone Number</th>
                    <th>Email</th>
                    <th>ID Class</th>
                    <th>Payment Status</th>
                    <th>Action</th>
                </tr>';

    while ($row = $result->fetch_assoc()) {
        echo '<tr>
                        <td>' . $row["member_id"] . '</td>
                        <td>' . $row["member_name"] . '</td>
                        <td>' . $row["phone_number"] . '</td>
                        <td>' . $row["email"] . '</td>
                        <td>' . $row["class_id"] . '</td>
                        <td>' . $row["payment_status"] . '</td>
                        <td>
                            <a href="update.php?member_id=' . $row['member_id'] . '">Update</a> 
                            <a href="delete.php?member_id=' . $row['member_id'] . '">Delete</a>
                            <a href="detailmember.php?member_id=' . $row['member_id'] . '">Details</a>
                            </td>
                    </tr>';
    }

    echo '</table>';
} else {
    echo "Error: " . $koneksi->error;
}

$koneksi->close();

?>

<a href="createmember.php" class="btn btn-primary">Add Membership</a>
<a href="logout.php" class="btn btn-secondary">Logout</a>