<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'admin') {
    header('Location: index.php');
    exit;
}

require_once '../../config/database.php';

$id = $_GET['id'] ?? null;

// Cannot delete self
if ($id && $id != $_SESSION['user']['id']) {
    $stmt = $pdo->prepare("DELETE FROM user WHERE id = ?");
    $stmt->execute([$id]);
}

header('Location: index.php');
exit;
?>
