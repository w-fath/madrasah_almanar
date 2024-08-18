<?php
// Koneksi ke database
include '../../koneksi/koneksi.php';

// Query untuk mengambil data dari tabel soal_ujian
$query = "SELECT * FROM soal_ujian";
$result = mysqli_query($conn, $query);
?>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="card-tools">
                    <div class="input-group input-group-sm">
                        <div class="input-group-append">
                            <a href="#" class="btn btn-default bg-warning"><i class="fas fa-print"></i> Print</a>
                            <a href="#" class="btn btn-default bg-success"><i class="fas fa-upload"></i> Import</a>
                            <a href="#" id="tambah-soal-btn" class="btn btn-default bg-primary"><i class="fas fa-plus-square"></i> Tambah Soal</a>
                            <style>
                                .bg-warning,
                                .bg-warning>a {
                                    color: #fff !important;
                                }
                            </style>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0" style="height: 300px;">
                <table class="table table-head-fixed text-nowrap">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Soal</th>
                            <th>A</th>
                            <th>B</th>
                            <th>C</th>
                            <th>D</th>
                            <th>Jawaban Benar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Inisialisasi nomor urut
                        $no = 1;
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . $no . "</td>";
                            echo "<td>" . $row['soal_text'] . "</td>";
                            echo "<td>" . $row['a'] . "</td>";
                            echo "<td>" . $row['b'] . "</td>";
                            echo "<td>" . $row['c'] . "</td>";
                            echo "<td>" . $row['d'] . "</td>";
                            echo "<td>" . $row['jawaban_benar'] . "</td>";
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