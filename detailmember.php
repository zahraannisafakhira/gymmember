<!DOCTYPE html>
<html>

<head>
    <title>Details Member Data</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
        }

        h1 {
            text-align: center;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        label {
            font-weight: bold;
        }

        input[type="text"],
        textarea,
        select {
            width: 100%;
            padding: 6px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 10px;
        }

        input[type="radio"] {
            margin-right: 5px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1 class="mt-4">Details Member Data</h1>
        <?php
        include 'koneksi.php';

        if (isset($_GET['member_id'])) {
            $member_id = $_GET['member_id'];
            $sql = "SELECT * FROM member WHERE member_id = $member_id";
            $result = $koneksi->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
        ?>

                <form action="proses_Details.php" method="post">
                    <!-- <input type="number" name="id_pembeli" value="<?php echo $row['id_pembeli']; ?>"> -->
                    <div class="form-group">
                        <label>Name:</label>
                        <input type="text" class="form-control" name="name" id="names" value="<?php echo $row['member_name']; ?>" readonly>
                    </div>

                    <div class="form-group">
                        <label>Phone Number:</label>
                        <input type="text" class="form-control" name="phone_number" id="phone_number" value="<?php echo $row['phone_number']; ?>" readonly>
                    </div>

                    <div class="form-group">
                        <label>Email:</label>
                        <input type="text" class="form-control" name="email" id="email" value="<?php echo $row['email']; ?>" readonly>
                    </div>

                    <div class="form-group">
                        <label>ID Class:</label>
                        <input type="text" class="form-control" name="class_id" id="class_id" value="<?php echo $row['class_id']; ?>" readonly>
                    </div>

                    <div class="form-group">
                        <label>Payment Status:</label>
                        <input type="text" class="form-control" name="payment_status" id="payment_status" value="<?php echo $row['payment_status']; ?>" readonly>
                    </div>

                    <!-- <div class="form-group">
                        <label for="harga">Total Bayar:</label>
                        <input type="text" class="form-control" name="harga" value="<?php echo $row['harga']; ?>">
                    </div> -->

                    <!-- <button type="submit" class="btn btn-primary">Update</button> -->
                    <button class="btn btn-secondary btn-kembali" onclick="location.href='index.php'; return false;">Kembali</button>
                </form>
        <?php
            }
        }
        $koneksi->close();
        ?>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>