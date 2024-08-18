<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: ../../../index.php");
    exit;
}

include '../../../koneksi/koneksi.php';
$fullname = isset($_SESSION['fullname']) ? $_SESSION['fullname'] : 'Guru';

// Logic untuk menyimpan soal ke database
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $id_ujian = $_POST['id_ujian'];
    $soal = $_POST['soal'];
    $jawaban_a = $_POST['a'];
    $jawaban_b = $_POST['b'];
    $jawaban_c = $_POST['c'];
    $jawaban_d = $_POST['d'];
    $jawaban_benar = $_POST['jawaban_benar'];

    // Query untuk memasukkan soal baru
    $query = "INSERT INTO soal_ujian (id_ujian, soal_text, a, b, c, d, jawaban_benar) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);

    if ($stmt === false) {
        die("Prepare failed: " . htmlspecialchars($conn->error));
    }

    $stmt->bind_param("sssssss", $id_ujian, $soal, $jawaban_a, $jawaban_b, $jawaban_c, $jawaban_d, $jawaban_benar);

    if ($stmt->execute()) {
        echo "<script>alert('Soal berhasil ditambahkan'); window.location.href = '../input.php';</script>";
    } else {
        echo "<script>alert('Gagal menambahkan soal: " . htmlspecialchars($stmt->error) . "');</script>";
    }

    $stmt->close();
    $conn->close();
}
?>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Tambah Soal Baru</h3>
                    </div>
                    <div class="card-body">
                        <form action="input_soal/add_soal.php" method="post">
                            <div class="form-group">
                                <label for="id_ujian">ID Ujian</label>
                                <input type="text" name="id_ujian" id="id_ujian" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="soal">Soal</label>
                                <textarea name="soal" id="soal" class="form-control" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="a">Jawaban A</label>
                                <input type="text" name="a" id="a" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="b">Jawaban B</label>
                                <input type="text" name="b" id="b" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="c">Jawaban C</label>
                                <input type="text" name="c" id="c" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="d">Jawaban D</label>
                                <input type="text" name="d" id="d" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="jawaban_benar">Jawaban Benar</label>
                                <select name="jawaban_benar" id="jawaban_benar" class="form-control" required>
                                    <option value="a">A</option>
                                    <option value="b">B</option>
                                    <option value="c">C</option>
                                    <option value="d">D</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Tambah Soal</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>