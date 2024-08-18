<?php
session_start();
include 'koneksi/koneksi.php';

if (!isset($_SESSION['notif_shown'])) {
    $_SESSION['notif_shown'] = false;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nis = $_POST['nis'];
    $password = $_POST['password'];

    $query = "SELECT * FROM siswa WHERE nis = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $nis);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $siswa = $result->fetch_assoc();

        if (MD5($password) == $siswa['password']) {
            $_SESSION['loggedin'] = true;
            $_SESSION['role'] = 'siswa';
            $_SESSION['nis'] = $siswa['nis'];
            $_SESSION['fullname'] = $siswa['nama'];
            $_SESSION['id_siswa'] = $siswa['id_siswa'];
            $_SESSION['kelas'] = $siswa['kelas'];

            // Redirect ke halaman dashboard siswa
            header("Location: page/siswa/dashboard.php");
            exit;
        } else {
            echo "<script>alert('Password salah!'); window.location.href='index.php';</script>";
        }
    } else {
        echo "<script>alert('NIS tidak ditemukan!'); window.location.href='index.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Madrasah Al-Manar | Ujian Online</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="asset/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <link rel="stylesheet" href="asset/dist/css/adminlte.min.css">
    <style>
        .custom-img {
            max-width: 100px;
            height: auto;
            display: block;
            margin: 0 auto 10px;
        }
    </style>
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="card">
            <div class="card-body login-card-body">
                <img src="asset/logo/icon.png" alt="" class="img-fluid custom-img">
                <p class="login-box-msg"><b>Login Siswa</b></p>
                <?php if (isset($error)): ?>
                    <div class="alert alert-danger"><?php echo $error; ?></div>
                <?php endif; ?>
                <form action="" method="post">
                    <div class="input-group mb-3">
                        <input type="text" name="nis" class="form-control" placeholder="Nomor Induk Siswa" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" name="password" class="form-control" placeholder="Password" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4 ml-auto">
                            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                        </div>
                    </div>
                </form>
                <a href="login.admin.guru.php">Admin & Guru</a>
            </div>
        </div>
    </div>
    <script src="asset/plugins/jquery/jquery.min.js"></script>
    <script src="asset/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="asset/dist/js/adminlte.min.js"></script>
</body>

</html>