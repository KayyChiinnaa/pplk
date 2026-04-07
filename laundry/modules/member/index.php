<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: ../../index.php');
    exit;
}

require_once '../../config/database.php';
$title = "Manajemen Member";

$stmt = $pdo->query("SELECT * FROM member ORDER BY id DESC");
$members = $stmt->fetchAll();

include '../../layouts/header.php';
?>

<div class="card">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
        <h3 style="margin-bottom: 0;">Daftar Member</h3>
        <a href="tambah.php" class="btn btn-primary" style="width: auto;">+ Tambah Member</a>
    </div>

    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>Jenis Kelamin</th>
                    <th>Telepon</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($members as $idx => $member): ?>
                    <tr>
                        <td><?= $idx + 1 ?></td>
                        <td><?= htmlspecialchars($member['nama']) ?></td>
                        <td><?= htmlspecialchars($member['alamat']) ?></td>
                        <td><?= ($member['jenis_kelamin'] == 'L') ? 'Laki-laki' : 'Perempuan' ?></td>
                        <td><?= htmlspecialchars($member['tlp']) ?></td>
                        <td>
                            <a href="edit.php?id=<?= $member['id'] ?>" style="color: var(--primary); margin-right: 1rem;">Edit</a>
                            <a href="hapus.php?id=<?= $member['id'] ?>" style="color: var(--danger);" onclick="return confirm('Apakah Anda yakin?')">Hapus</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                <?php if (empty($members)): ?>
                    <tr>
                        <td colspan="6" style="text-align: center; color: var(--text-muted);">Belum ada data member.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include '../../layouts/footer.php'; ?>
