<?php
session_start();
require __DIR__ . '/../config.php';

$token = $_POST['token'] ?? '';
$pass = $_POST['password'] ?? '';
$confirm = $_POST['confirm_password'] ?? '';

if (!$token || !$pass || !$confirm) die("Tous les champs sont obligatoires.");
if ($pass !== $confirm) die("Les mots de passe ne correspondent pas.");

// Vérifier token valide
$stmt = $pdo->prepare("SELECT * FROM users WHERE reset_token=? AND reset_expires > NOW()");
$stmt->execute([$token]);
$user = $stmt->fetch();
if (!$user) die("Token invalide ou expiré.");

// Mettre à jour mot de passe et vider token
$hash = password_hash($pass, PASSWORD_BCRYPT);
$stmt = $pdo->prepare("UPDATE users SET password_hash=?, reset_token=NULL, reset_expires=NULL WHERE id=?");
$stmt->execute([$hash, $user['id']]);

echo "Mot de passe réinitialisé avec succès. <a href='login.php'>Se connecter</a>";
?>
