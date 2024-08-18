<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: ../../index.php");
    exit();
}

$nis = $_SESSION['nis'];
$nama = $_SESSION['fullname'];
$kelas = $_SESSION['kelas'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Madrasah Al-Manar | Ujian Online</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../../asset/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <link rel="stylesheet" href="../../asset/dist/css/adminlte.min.css">
    <style>
        .custom-img {
            max-width: 100px;
            height: auto;
            display: block;
            margin: 0 auto 10px;
        }

        .login-box {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            padding: 20px;
        }

        .card {
            width: 100%;
            max-width: 400px;
        }

        .box {
            margin-bottom: 20px;
            padding: 15px;
            background-color: #f4f4f4;
            border-radius: 5px;
        }

        .box p {
            margin: 5px 0;
            padding: 0;
        }

        .dots-container {
            display: inline-block;
            margin-top: -50px;
        }

        .dot {
            font-size: 24px;
            animation: dot-blink 1s step-start infinite;
            display: inline;
        }

        @keyframes dot-blink {
            0% {
                opacity: 0;
            }

            100% {
                opacity: 1;
            }
        }
    </style>
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="card">
            <div class="card-body login-card-body">
                <img src="../../asset/logo/icon.png" alt="" class="img-fluid custom-img">
                <p class="login-box-msg">Tunggu token dari Administrator!</p>
                <div class="box">
                    <p><b>Data Siswa</b></p>
                    <p>Nis : <?php echo htmlspecialchars($nis); ?></p>
                    <p>Nama : <?php echo htmlspecialchars($nama); ?></p>
                    <p>Kelas : <?php echo htmlspecialchars($kelas); ?></p>
                    <p>Materi : <span class="dots-container" id="dots-container"></span></p>
                </div>
                <div class="input-group mb-3">
                    <input type="text" name="token" class="form-control" placeholder="Token" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-key"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-5 ml-auto">
                        <button type="submit" class="btn btn-primary btn-block">Mulai Ujian</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="../../asset/plugins/jquery/jquery.min.js"></script>
    <script src="../../asset/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../../asset/dist/js/adminlte.min.js"></script>
    <script>
        const container = document.getElementById('dots-container');
        let dotCount = 0;
        const maxDots = 9;

        function updateDots() {
            container.innerHTML = '';
            for (let i = 0; i < dotCount; i++) {
                const dot = document.createElement('span');
                dot.classList.add('dot');
                dot.textContent = '.';
                container.appendChild(dot);
            }
        }

        function animateDots() {
            dotCount = (dotCount % maxDots) + 1;
            updateDots();
        }

        setInterval(animateDots, 200);
    </script>
</body>

</html>