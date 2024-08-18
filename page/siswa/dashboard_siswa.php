<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: ../../index.php");
    exit;
}
// siswa
$totalQuery = "SELECT COUNT(*) AS total_siswa FROM siswa";
$totalResult = $conn->query($totalQuery);
if (!$totalResult) {
    die("Query gagal: " . $conn->error);
}
$totalRow = $totalResult->fetch_assoc();
$totalSiswa = $totalRow['total_siswa'];

// guru
$totalGuruQuery = "SELECT COUNT(*) AS total_guru FROM guru";
$totalGuruResult = $conn->query($totalGuruQuery);
if (!$totalGuruResult) {
    die("Query gagal: " . $conn->error);
}
$totalGuruRow = $totalGuruResult->fetch_assoc();
$totalGuru = $totalGuruRow['total_guru'];

// Soal
$totalSoalQuery = "SELECT COUNT(*) AS total_soal FROM soal_ujian";
$totalSoalResult = $conn->query($totalSoalQuery);
if (!$totalSoalResult) {
    die("Query gagal: " . $conn->error);
}
$totalSoalRow = $totalSoalResult->fetch_assoc();
$totalSoal = $totalSoalRow['total_soal'];
?>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3><?= $totalSiswa; ?></h3>
                        <p>Jumlah Siswa</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3><?= $totalGuru; ?></h3>

                        <p>Jumlah Guru</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-user-graduate"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3 style="color: #fff;"><?= $totalSoal; ?></h3>

                        <p style="color: #fff;">Soal Terdaftar</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-clipboard-list"></i>
                    </div>
                    <a href="#" class="warna small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    <style>
                        .bg-warning,
                        .bg-warning>a {
                            color: #fff !important;
                        }
                    </style>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>1</h3>

                        <p>Team IT</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-user-secret"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Hasil Ujian</h3>

                    <div class="card-tools">
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0" style="height: 300px;">
                    <table class="table table-head-fixed text-nowrap">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>Materi</th>
                                <th>Nama Guru</th>
                                <th>Jam Pelaksanaan</th>
                                <th>Nilai</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1.</td>
                                <td>Update software</td>
                                <td>Abd. Rofi</td>
                                <td>07.30 - 08.30</td>
                                <td><span class="badge bg-danger" style="font-size: 13px;">55%</span></td>
                            </tr>
                            <tr>
                                <td>2.</td>
                                <td>Clean database</td>
                                <td>Abd. Rasyid</td>
                                <td>07.30 - 08.30</td>
                                <td><span class="badge bg-warning" style="font-size: 13px;">70%</span></td>
                            </tr>
                            <tr>
                                <td>3.</td>
                                <td>Cron job running</td>
                                <td>Musyfiqul Anwar</td>
                                <td>07.30 - 08.30</td>
                                <td><span class="badge bg-primary" style="font-size: 13px;">80%</span></td>
                            </tr>
                            <tr>
                                <td>4.</td>
                                <td>Fix and squish bugs</td>
                                <td>Naufan Himam</td>
                                <td>07.30 - 08.30</td>
                                <td><span class="badge bg-success" style="font-size: 13px;">100%</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>