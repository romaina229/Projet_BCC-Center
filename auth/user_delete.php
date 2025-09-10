<?php
require_once "../config.php"; 
require_login();

if (!in_array(current_user()['role'], ['admin'])) {
    die("⛔ Accès refusé");
}

$id = intval($_GET['id'] ?? 0);

// Empêcher l’admin de supprimer son propre compte
if ($id == current_user()['id']) {
    die("Vous ne pouvez pas supprimer votre propre compte !");
}

$stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
$stmt->execute([$id]);

header("Location: users.php");
exit;
user