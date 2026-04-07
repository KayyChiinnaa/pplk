<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: ../../index.php');
    exit;
}

require_once '../../config/database.php';
$title = "Manajemen User";

$stmt = $pdo->query("SELECT user.*, outlet.nama as nama_outlet FROM user LEFT JOIN outlet ON user.id_outlet = outlet.id ORDER BY user.id DESC");
$users = $stmt->fetchAll();

include '../../layouts/header.php';
?>

<div class="card">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
        <h3 style="margin-bottom: 0;">Daftar Pengguna Sistem</h3>
        <?php if ($_SESSION['user']['role'] == 'admin'): ?>
            <a href="tambah.php" class="btn btn-primary" style="width: auto;">+ Tambah User</a>
        <?php endif; ?>
    </div>

    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Username</th>
                    <th>Outlet</th>
                    <th>Role</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $idx => $u): ?>
                    <tr>
                        <td><?= $idx + 1 ?></td>
                        <td><?= htmlspecialchars($u['nama']) ?></td>
                        <td><?= htmlspecialchars($u['username']) ?></td>
                        <td><?= htmlspecialchars($u['nama_outlet'] ?? '-') ?></td>
                        <td><span class="badge badge-<?= $u['role'] ?>"><?= ucfirst($u['role']) ?></span></td>
                        <td>
                            <?php if ($_SESSION['user']['role'] == 'admin'): ?>
                                <a href="edit.php?id=<?= $u['id'] ?>" style="color: var(--primary); margin-right: 1rem;">Edit</a>
                                <?php if ($u['id'] != $_SESSION['user']['id']): ?>
                                    <a href="hapus.php?id=<?= $u['id'] ?>" style="color: var(--danger);" onclick="return confirm('Apakah Anda yakin?')">Hapus</a>
                                <?php endif; ?>
                            <?php else: ?>
                                <span style="color: var(--text-muted);">No Action</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include '../../layouts/footer.php'; ?>
