<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: ../../index.php");
    exit;
}
include '../../koneksi/koneksi.php';

// Query untuk mendapatkan data siswa beserta nilai terbarunya dengan pencarian
$search = isset($_GET['table_search']) ? $_GET['table_search'] : '';
$query = "
    SELECT siswa.id_siswa, siswa.nis, siswa.nama, siswa.kelas, 
           COALESCE(MAX(nilai.nilai), 'N/A') AS nilai
    FROM siswa
    LEFT JOIN nilai ON siswa.id_siswa = nilai.id_siswa
    WHERE siswa.nis LIKE ? OR 
          siswa.nama LIKE ? OR 
          siswa.kelas LIKE ? OR 
          COALESCE(nilai.nilai, 'N/A') LIKE ?
    GROUP BY siswa.id_siswa, siswa.nis, siswa.nama, siswa.kelas
";

// Prepare statement
$stmt = $conn->prepare($query);
$searchTerm = "%$search%";
$stmt->bind_param('ssss', $searchTerm, $searchTerm, $searchTerm, $searchTerm);
$stmt->execute();
$result = $stmt->get_result();

if (!$result) {
    die("Query gagal: " . $conn->error);
}

// Query untuk menghitung total siswa
$totalQuery = "SELECT COUNT(*) AS total_siswa FROM siswa";
$totalResult = $conn->query($totalQuery);
if (!$totalResult) {
    die("Query gagal: " . $conn->error);
}
$totalRow = $totalResult->fetch_assoc();
$totalSiswa = $totalRow['total_siswa'];
?>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- Statistik Box -->
            <div class="col-lg-3 col-6">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3><?php echo $totalSiswa; ?></h3>
                        <p>Jumlah Siswa</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>53<sup style="font-size: 20px">%</sup></h3>
                        <p>Jumlah Guru</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-user-graduate"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3 style="color: #fff;">44</h3>
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
            <div class="col-lg-3 col-6">
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
                    <h3 class="card-title">Data Siswa</h3>

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
                <div class="card-body table-responsive p-0" style="height: 300px;">
                    <table class="table table-head-fixed text-nowrap">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>NIS</th>
                                <th>Nama</th>
                                <th>Kelas</th>
                                <th>Nilai</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>{$no}</td>";
                                echo "<td>{$row['nis']}</td>";
                                echo "<td>{$row['nama']}</td>";
                                echo "<td><span class='tag tag-success'>{$row['kelas']}</span></td>";
                                echo "<td>{$row['nilai']}</td>";
                                echo "</tr>";
                                $no++;
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>