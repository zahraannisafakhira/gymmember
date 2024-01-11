<!DOCTYPE html>
<html>

<head>
    <title>Create Class</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            padding-top: 50px;
            margin: 0;
        }

        .container {
            margin-top: 30px;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
            color: #007bff;
        }

        .form-group {
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Create Class</h1>
        <form action="proses_class.php" method="POST">

            <!-- <div class="form-group">
                <label>ID Member:</label>
                <input type="text" class="form-control" name="id_member" id="id_member" required>
            </div> -->

            <div class="form-group">
                <label>Class Name:</label>
                <input type="text" class="form-control" name="class_name" id="class_name" required>
            </div>

            <div class="form-group">
                <label>Price:</label>
                <input type="text" class="form-control" name="price" id="price" required>
            </div>

            <!-- <div class="form-group">
                <label>Email:</label>
                <input type="text" class="form-control" name="email" id="email" required>
            </div>

            <div class="form-group">
                <label>Class Name:</label>
                <input type="text" class="form-control" name="class_name" id="class_name" required>
            </div>

            <div class="form-group">
                <label>Payment Status:</label>
                <select class="form-control" name="payment_status" id="payment_status" required>
                    <option value="Completed">Completed</option>
                    <option value="On Progress">On Progess</option>
                </select>
            </div> -->

            <!-- <div class="form-group">
                <label>Tanggal Transaksi:</label>
                <input type="date" class="form-control" name="tgl_transaksi" id="tgl_transaksi" required>
            </div> -->

            <!-- <div class="form-group">
                <label>Jenis Barang:</label>
                <select class="form-control" name="jenis_barang" id="jenis_barang" required>
                    <option value="Makanan">Makanan</option>
                    <option value="Minuman">Minuman</option>
                </select>
            </div>

            <div class="form-group">
                <label>Nama Barang:</label>
                <input type="text" class="form-control" name="nama_barang" id="nama_barang" required>
            </div>

            <div class="form-group">
                <label>Jumlah:</label>
                <input type="text" class="form-control" name="jumlah" id="jumlah" required>
            </div>

            <div class="form-group">
                <label>Harga:</label>
                <input type="text" class="form-control" name="harga" id="harga" required>
            </div> -->

            <input type="submit" class="btn btn-primary" value="Submit">
        </form>

        <!-- <script>
            function sendData() {
                var xhr = new XMLHttpRequest();
                var url = "https://jsonplaceholder.typicode.com/posts";

                var data = JSON.stringify({
                    ID_Pembeli: document.getElementById("id_pembeli").value,
                    Nama: document.getElementById("nama").value,
                    Alamat: document.getElementById("alamat").value,
                    HP: document.getElementById("hp").value,
                    Tanggal_Transaksi: document.getElementById("tgl_transaksi").value,
                    Jenis_Barang: document.getElementById("jenis_barang").value,
                    Nama_Barang: document.getElementById("nama_barang").value,
                    Jumlah: document.getElementById("jumlah").value,
                    Harga: document.getElementById("harga").value
                });

                xhr.open("POST", url, true);
                xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
                xhr.onload = function() {
                    console.log(this.responseText);
                };

                xhr.send(data);
                return false;
            }
        </script> -->

        <br><a href="index.php" class="btn btn-success">Back</a>
    </div>
</body>

</html>