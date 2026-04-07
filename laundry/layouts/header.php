<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/laundry/assets/css/style.css">
</head>
<body>
    <div class="sidebar-overlay" id="sidebarOverlay"></div>
    <div class="wrapper">
<?php include 'sidebar.php'; ?>
        <div class="content">
            <header class="top-nav">
                <div style="display: flex; align-items: center; gap: 1rem;">
                    <button class="menu-toggle" id="menuToggle">
                        ☰
                    </button>
                    <h2><?= $title ?? 'Dashboard' ?></h2>
                </div>
                <div class="user-profile">
                    <span><strong><?= $_SESSION['user']['nama'] ?? 'Guest' ?></strong> (<?= ucfirst($_SESSION['user']['role'] ?? '') ?>)</span>
                </div>
            </header>
