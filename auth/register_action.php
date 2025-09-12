<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once __DIR__ . "/../config.php";

// Récupération des champs
$nom_prenom = trim($_POST['nom_prenom'] ?? '');
$username   = trim($_POST['username'] ?? '');
$email      = trim($_POST['email'] ?? '');
$pass       = $_POST['password'] ?? '';
$role       = $_POST['role'] ?? 'participant';

// Vérification des champs obligatoires
if (!$nom_prenom || !$username || !$email || !$pass) {
    die("Champs obligatoires manquants.");
}

// Vérifier si l'email existe déjà
$stmt = $pdo->prepare("SELECT id FROM users WHERE email=?");
$stmt->execute([$email]);
if ($stmt->fetch()) {
    die("Email déjà utilisé.");
}

// Générer valeurs par défaut
$hash      = password_hash($pass, PASSWORD_BCRYPT);
$user_id   = uniqid("USR_"); // identifiant unique
$created_at = date('Y-m-d H:i:s');

// Préparer la requête
$stmt = $pdo->prepare("
    INSERT INTO users 
    (user_id, nom_prenom, username, email, password_hash, role, created_at) 
    VALUES (?, ?, ?, ?, ?, ?, ?)
");
$stmt->execute([$user_id, $nom_prenom, $username, $email, $hash, $role, $created_at]);

// Auto-login
$id = $pdo->lastInsertId();
$_SESSION['user'] = [
    'id'          => $id,
    'user_id'     => $user_id,
    'nom_prenom'  => $nom_prenom,
    'username'    => $username,
    'email'       => $email,
    'role'        => $role,
    'created_at'  => $created_at
];

// Redirection
header("Location: /dashboard/index.php");
exit;