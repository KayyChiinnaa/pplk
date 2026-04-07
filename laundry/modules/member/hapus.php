<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: ../../index.php');
    exit;
}

require_once '../../config/database.php';

$id = $_GET['id'] ?? null;
if ($id) {
    $stmt = $pdo->prepare("DELETE FROM member WHERE id = ?");
    $stmt->execute([$id]);
}

header('Location: index.php');
exit;
?>
