<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: ../../index.php');
    exit;
}

require_once '../../config/database.php';
$title = "Edit Outlet";

$id = $_GET['id'] ?? null;
if (!$id) {
    header('Location: index.php');
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM outlet WHERE id = ?");
$stmt->execute([$id]);
$outlet = $stmt->fetch();

if (!$outlet) {
    header('Location: index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'] ?? '';
    $alamat = $_POST['alamat'] ?? '';
    $tlp = $_POST['tlp'] ?? '';

    $stmt = $pdo->prepare("UPDATE outlet SET nama = ?, alamat = ?, tlp = ? WHERE id = ?");
    $stmt->execute([$nama, $alamat, $tlp, $id]);

    header('Location: index.php');
    exit;
}

include '../../layouts/header.php';
?>

<div class="card" style="max-width: 600px; margin: 0 auto;">
    <h3 style="margin-bottom: 1.5rem;">Form Edit Outlet</h3>
    <form action="" method="POST">
        <div class="form-group">
            <label for="nama">Nama Outlet</label>
            <input type="text" id="nama" name="nama" class="form-input" value="<?= htmlspecialchars($outlet['nama']) ?>" required>
        </div>
        <div class="form-group">
            <label for="alamat">Alamat</label>
            <textarea id="alamat" name="alamat" class="form-input" rows="3" required><?= htmlspecialchars($outlet['alamat']) ?></textarea>
        </div>
        <div class="form-group">
            <label for="tlp">No. Telepon</label>
            <input type="text" id="tlp" name="tlp" class="form-input" value="<?= htmlspecialchars($outlet['tlp']) ?>" required>
        </div>
        <div style="display: flex; gap: 1rem;">
            <button type="submit" class="btn btn-primary" style="flex: 1;">PERBARUI</button>
            <a href="index.php" class="btn" style="background-color: var(--secondary); color: white; flex: 1; text-align: center;">BATAL</a>
        </div>
    </form>
</div>

<?php include '../../layouts/footer.php'; ?>
