<!DOCTYPE html>
<html lang="en">

<head>
    <!-- meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <!-- custom css -->
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php
    // menyertakan file program koneksi.php pada register
    require('koneksi.php');

    // inisialisasi session
    session_start();

    $error = '';
    $validate = '';

    // cek apakah user sudah login, jika ya, redirect ke index.php
    if (isset($_SESSION['username'])) {
        header('Location: index.php');
    }

    // mengecek apakah form telah disubmit
    if (isset($_POST['submit'])) {
        // menghilangkan backslashes
        $username = stripslashes($_POST['username']);
        $username = mysqli_real_escape_string($koneksi, $username);

        $name = stripslashes($_POST['name']);
        $name = mysqli_real_escape_string($koneksi, $name);

        $email = stripslashes($_POST['email']);
        $email = mysqli_real_escape_string($koneksi, $email);

        $password = stripslashes($_POST['password']);
        $password = mysqli_real_escape_string($koneksi, $password);

        $repass = stripslashes($_POST['repassword']);
        $repass = mysqli_real_escape_string($koneksi, $repass);

        // cek apakah semua field diisi
        if (!empty(trim($name)) && !empty(trim($username)) && !empty(trim($email)) && !empty(trim($password)) && !empty(trim($repass))) {
            // cek apakah password dan re-password sama
            if ($password == $repass) {
                // cek apakah username sudah terdaftar
                if (cek_nama($username, $koneksi) == 0) {
                    // hashing password sebelum disimpan di database
                    $pass = password_hash($password, PASSWORD_DEFAULT);
                    // insert data ke database
                    $query = "INSERT INTO admin (username, admin_name, email, password) VALUES ('$username', '$name', '$email', '$pass')";
                    $result = mysqli_query($koneksi, $query);

                    // jika insert data berhasil maka akan di-redirect ke halaman index.php serta menyimpan data username ke session
                    if ($result) {
                        $_SESSION['username'] = $username;
                        header('Location: index.php');
                    } else {
                        $error = 'Register User Gagal!!';
                    }
                } else {
                    $error = 'Username sudah terdaftar!!';
                }
            } else {
                $validate = 'Password tidak sama!!';
            }
        } else {
            $error = 'Data tidak boleh kosong!!';
        }
    }

    // fungsi untuk mengecek username apakah sudah terdaftar atau belum
    function cek_nama($username, $koneksi)
    {
        $name = mysqli_real_escape_string($koneksi, $username);
        $query = "SELECT * FROM admin WHERE username = '$name'";
        $result = mysqli_query($koneksi, $query);
        return mysqli_num_rows($result);
    }
    ?>

    <section class="container-fluid mb-4">
        <!-- justify-content-center untuk mengatur posisi form agar berada di tengah-tengah -->
        <section class="row justify-content-center">
            <section class="col-12 col-sm-6 col-md-4">
                <form class="form-container" action="register.php" method="POST">
                    <h4 class="text-center font-weight-bold"> Register </h4>
                    <?php if ($error != '') { ?>
                        <div class="alert alert-danger" role="alert"><?= $error; ?></div>
                    <?php } ?>

                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Name">
                    </div>

                    <div class="form-group">
                        <label for="InputEmail">Email</label>
                        <input type="email" class="form-control" id="InputEmail" name="email" aria-describedby="emailHelp" placeholder="Email">
                    </div>

                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="Username">
                    </div>

                    <div class="form-group">
                        <label for="InputPassword">Password</label>
                        <input type="password" class="form-control" id="InputPassword" name="password" placeholder="Password">
                        <?php if ($validate != '') { ?>
                            <p class="text-danger"><?= $validate; ?></p>
                        <?php } ?>
                    </div>

                    <div class="form-group">
                        <label for="InputRePassword">Re-Password</label>
                        <input type="password" class="form-control" id="InputRePassword" name="repassword" placeholder="Re-Password">
                        <?php if ($validate != '') { ?>
                            <p class="text-danger"><?= $validate; ?></p>
                        <?php } ?>
                    </div>

                    <button type="submit" name="submit" class="btn btn-primary btn-block">Register</button>
                    <div class="form-footer mt-2">
                        <p> Already have an account? <a href="login.php">Login</a></p>
                    </div>
                </form>
            </section>
        </section>
    </section>

    <!-- Bootstrap requirement jQuery pada posisi pertama, kemudian Popper.js, dan yang terakhit Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ60W/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>

</html>