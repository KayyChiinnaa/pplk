<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: index.php');
    exit;
}

require_once 'config/database.php';

$title = "Dashboard";

// Fetch some statistics
$stmt_outlet = $pdo->query("SELECT COUNT(*) FROM outlet");
$count_outlet = $stmt_outlet->fetchColumn();

$stmt_member = $pdo->query("SELECT COUNT(*) FROM member");
$count_member = $stmt_member->fetchColumn();

$stmt_user = $pdo->query("SELECT COUNT(*) FROM user");
$count_user = $stmt_user->fetchColumn();

include 'layouts/header.php';
?>

<div class="dashboard-stats" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 1.5rem;">
    <div class="card" style="border-left: 5px solid var(--primary);">
        <h3>Total Outlet</h3>
        <p style="font-size: 2rem; font-weight: 700; color: var(--primary);"><?= $count_outlet ?></p>
    </div>
    <div class="card" style="border-left: 5px solid var(--success);">
        <h3>Total Member</h3>
        <p style="font-size: 2rem; font-weight: 700; color: var(--success);"><?= $count_member ?></p>
    </div>
    <div class="card" style="border-left: 5px solid var(--warning);">
        <h3>Total User</h3>
        <p style="font-size: 2rem; font-weight: 700; color: var(--warning);"><?= $count_user ?></p>
    </div>
</div>

<div class="card">
    <h3>Quick Overview</h3>
    <p>Selamat datang di panel manajemen Laundry BN. Gunakan menu di samping untuk mengelola data operasional Anda.</p>
</div>

<?php include 'layouts/footer.php'; ?>
