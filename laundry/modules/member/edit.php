<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: ../../index.php');
    exit;
}

require_once '../../config/database.php';
$title = "Edit Member";

$id = $_GET['id'] ?? null;
if (!$id) {
    header('Location: index.php');
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM member WHERE id = ?");
$stmt->execute([$id]);
$member = $stmt->fetch();

if (!$member) {
    header('Location: index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'] ?? '';
    $alamat = $_POST['alamat'] ?? '';
    $jenis_kelamin = $_POST['jenis_kelamin'] ?? '';
    $tlp = $_POST['tlp'] ?? '';

    $stmt = $pdo->prepare("UPDATE member SET nama = ?, alamat = ?, jenis_kelamin = ?, tlp = ? WHERE id = ?");
    $stmt->execute([$nama, $alamat, $jenis_kelamin, $tlp, $id]);

    header('Location: index.php');
    exit;
}

include '../../layouts/header.php';
?>

<div class="card" style="max-width: 600px; margin: 0 auto;">
    <h3 style="margin-bottom: 1.5rem;">Form Edit Member</h3>
    <form action="" method="POST">
        <div class="form-group">
            <label for="nama">Nama Lengkap</label>
            <input type="text" id="nama" name="nama" class="form-input" value="<?= htmlspecialchars($member['nama']) ?>" required>
        </div>
        <div class="form-group">
            <label for="alamat">Alamat</label>
            <textarea id="alamat" name="alamat" class="form-input" rows="3" required><?= htmlspecialchars($member['alamat']) ?></textarea>
        </div>
        <div class="form-group">
            <label for="jenis_kelamin">Jenis Kelamin</label>
            <select id="jenis_kelamin" name="jenis_kelamin" class="form-input" required>
                <option value="L" <?= ($member['jenis_kelamin'] == 'L') ? 'selected' : '' ?>>Laki-laki</option>
                <option value="P" <?= ($member['jenis_kelamin'] == 'P') ? 'selected' : '' ?>>Perempuan</option>
            </select>
        </div>
        <div class="form-group">
            <label for="tlp">No. Telepon</label>
            <input type="text" id="tlp" name="tlp" class="form-input" value="<?= htmlspecialchars($member['tlp']) ?>" required>
        </div>
        <div style="display: flex; gap: 1rem;">
            <button type="submit" class="btn btn-primary" style="flex: 1;">PERBARUI</button>
            <a href="index.php" class="btn" style="background-color: var(--secondary); color: white; flex: 1; text-align: center;">BATAL</a>
        </div>
    </form>
</div>

<?php include '../../layouts/footer.php'; ?>
