<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: ../../index.php');
    exit;
}

require_once '../../config/database.php';
$title = "Tambah Member";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'] ?? '';
    $alamat = $_POST['alamat'] ?? '';
    $jenis_kelamin = $_POST['jenis_kelamin'] ?? '';
    $tlp = $_POST['tlp'] ?? '';

    $stmt = $pdo->prepare("INSERT INTO member (nama, alamat, jenis_kelamin, tlp) VALUES (?, ?, ?, ?)");
    $stmt->execute([$nama, $alamat, $jenis_kelamin, $tlp]);

    header('Location: index.php');
    exit;
}

include '../../layouts/header.php';
?>

<div class="card" style="max-width: 600px; margin: 0 auto;">
    <h3 style="margin-bottom: 1.5rem;">Form Tambah Member</h3>
    <form action="" method="POST">
        <div class="form-group">
            <label for="nama">Nama Lengkap</label>
            <input type="text" id="nama" name="nama" class="form-input" required>
        </div>
        <div class="form-group">
            <label for="alamat">Alamat</label>
            <textarea id="alamat" name="alamat" class="form-input" rows="3" required></textarea>
        </div>
        <div class="form-group">
            <label for="jenis_kelamin">Jenis Kelamin</label>
            <select id="jenis_kelamin" name="jenis_kelamin" class="form-input" required>
                <option value="">-- Pilih Jenis Kelamin --</option>
                <option value="L">Laki-laki</option>
                <option value="P">Perempuan</option>
            </select>
        </div>
        <div class="form-group">
            <label for="tlp">No. Telepon</label>
            <input type="text" id="tlp" name="tlp" class="form-input" required>
        </div>
        <div style="display: flex; gap: 1rem;">
            <button type="submit" class="btn btn-primary" style="flex: 1;">SIMPAN</button>
            <a href="index.php" class="btn" style="background-color: var(--secondary); color: white; flex: 1; text-align: center;">BATAL</a>
        </div>
    </form>
</div>

<?php include '../../layouts/footer.php'; ?>
