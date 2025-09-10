<?php
require_once "../config.php";

$nom_prenom = trim($_POST['nom_prenom'] ?? '');
$email = trim($_POST['email'] ?? '');
$pass = $_POST['password'] ?? '';
$role = $_POST['role'] ?? 'participant';

if (!$nom_prenom || !$email || !$pass) { die("Champs obligatoires manquants."); }

$stmt = $pdo->prepare("SELECT id FROM users WHERE email=?");
$stmt->execute([$email]);
if ($stmt->fetch()) { die("Email déjà utilisé."); }

$hash = password_hash($pass, PASSWORD_BCRYPT);
$stmt = $pdo->prepare("INSERT INTO users (nom_prenom, email, password_hash, role) VALUES (?,?,?,?)");
$stmt->execute([$nom_prenom, $email, $hash, $role]);

// Auto-login
$id = $pdo->lastInsertId();
$_SESSION['user'] = ['id'=>$id,'nom_prenom'=>$nom_prenom,'email'=>$email,'role'=>$role];
header("Location: /dashboard/index.php");