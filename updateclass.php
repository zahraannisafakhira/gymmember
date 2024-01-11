<!DOCTYPE html>
<html>

<head>
    <title>Update Class</title>
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
        <h1 class="mt-4">Update Class</h1>
        <?php
        include 'koneksi.php';

        if (isset($_GET['class_id'])) {
            $class_id = $_GET['class_id'];
            $sql = "SELECT * FROM class WHERE class_id = $class_id";
            $result = $koneksi->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();

                // $class_id = $row["class_id"];
                // $selectQuery = "SELECT class_name FROM class Where class_id = '$class_id'";

                // $res = $koneksi->query($selectQuery);

                // if ($res) {
                //     $row1 = $res->fetch_assoc();
                //     $class_name = $row1["class_name"];
                // } else {
                //     echo "Error: " . $koneksi->error;
                // }
        ?>
                <form action="proses_updateclass.php" method="post">
                    <div class="form-group">
                        <label for="class_id">ID Member:</label>
                        <input type="text" class="form-control" name="class_id" value="<?php echo htmlspecialchars($row['class_id']); ?>" readonly>
                    </div>

                    <div class="form-group">
                        <label for="class_name">Name:</label>
                        <input type="text" class="form-control" name="class_name" value="<?php echo htmlspecialchars($row['class_name']); ?>">
                    </div>

                    <div class="form-group">
                        <label for="price">Price:</label>
                        <input type="text" class="form-control" name="price" value="<?php echo $row['price']; ?>">
                    </div>

                    <!-- <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="text" class="form-control" name="email" value="<?php echo $row['email']; ?>">
                    </div>

                    <div class="form-group">
                        <label>Class Name:</label>
                        <input type="text" class="form-control" name="class_name" id="class_name" value="<?php echo $row1['class_name']; ?>">
                    </div>

                    <div class="form-group">
                        <label for="jenis_barang">Payment Status:</label>
                        <select class="form-control" name="payment_status" required>
                            <option value="Overdue" <?php echo ($row['payment_status'] == 'Overdue') ? 'selected' : ''; ?>>Overdue</option>
                            <option value="Cancelled" <?php echo ($row['payment_status'] == 'Cancelled') ? 'selected' : ''; ?>>Cancelled</option>
                            <option value="Completed" <?php echo ($row['payment_status'] == 'Completed') ? 'selected' : ''; ?>>Completed</option>
                            <option value="On Progress" <?php echo ($row['payment_status'] == 'On Progress') ? 'selected' : ''; ?>>On Progress</option>
                        </select>
                    </div> -->

                    <button type="submit" class="btn btn-primary">Update</button>
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