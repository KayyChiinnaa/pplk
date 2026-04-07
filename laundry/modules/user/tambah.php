<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'admin') {
    header('Location: index.php');
    exit;
}

require_once '../../config/database.php';
$title = "Tambah User";

$outlets = $pdo->query("SELECT * FROM outlet")->fetchAll();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'] ?? '';
    $username = $_POST['username'] ?? '';
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $id_outlet = $_POST['id_outlet'] ?: null;
    $role = $_POST['role'] ?? 'kasir';

    $stmt = $pdo->prepare("INSERT INTO user (nama, username, password, id_outlet, role) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$nama, $username, $password, $id_outlet, $role]);

    header('Location: index.php');
    exit;
}

include '../../layouts/header.php';
?>

<div class="card" style="max-width: 600px; margin: 0 auto;">
    <h3 style="margin-bottom: 1.5rem;">Form Tambah Pengguna</h3>
    <form action="" method="POST">
        <div class="form-group">
            <label for="nama">Nama Lengkap</label>
            <input type="text" id="nama" name="nama" class="form-input" required>
        </div>
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" id="username" name="username" class="form-input" required>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" class="form-input" required>
        </div>
        <div class="form-group">
            <label for="id_outlet">Outlet</label>
            <select id="id_outlet" name="id_outlet" class="form-input">
                <option value="">-- Tanpa Outlet (Admin/Owner) --</option>
                <?php foreach ($outlets as $o): ?>
                    <option value="<?= $o['id'] ?>"><?= htmlspecialchars($o['nama']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="role">Role</label>
            <select id="role" name="role" class="form-input" required>
                <option value="kasir">Kasir</option>
                <option value="admin">Admin</option>
                <option value="owner">Owner</option>
            </select>
        </div>
        <div style="display: flex; gap: 1rem;">
            <button type="submit" class="btn btn-primary" style="flex: 1;">SIMPAN</button>
            <a href="index.php" class="btn" style="background-color: var(--secondary); color: white; flex: 1; text-align: center;">BATAL</a>
        </div>
    </form>
</div>

<?php include '../../layouts/footer.php'; ?>
