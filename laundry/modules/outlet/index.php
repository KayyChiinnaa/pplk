<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: ../../index.php');
    exit;
}

require_once '../../config/database.php';
$title = "Manajemen Outlet";

$stmt = $pdo->query("SELECT * FROM outlet ORDER BY id DESC");
$outlets = $stmt->fetchAll();

include '../../layouts/header.php';
?>

<div class="card">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
        <h3 style="margin-bottom: 0;">Daftar Outlet</h3>
        <a href="tambah.php" class="btn btn-primary" style="width: auto;">+ Tambah Outlet</a>
    </div>

    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Outlet</th>
                    <th>Alamat</th>
                    <th>No. Telepon</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($outlets as $idx => $outlet): ?>
                    <tr>
                        <td><?= $idx + 1 ?></td>
                        <td><?= htmlspecialchars($outlet['nama']) ?></td>
                        <td><?= htmlspecialchars($outlet['alamat']) ?></td>
                        <td><?= htmlspecialchars($outlet['tlp']) ?></td>
                        <td>
                            <a href="edit.php?id=<?= $outlet['id'] ?>" style="color: var(--primary); margin-right: 1rem;">Edit</a>
                            <a href="hapus.php?id=<?= $outlet['id'] ?>" style="color: var(--danger);" onclick="return confirm('Apakah Anda yakin?')">Hapus</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                <?php if (empty($outlets)): ?>
                    <tr>
                        <td colspan="5" style="text-align: center; color: var(--text-muted);">Belum ada data.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include '../../layouts/footer.php'; ?>
