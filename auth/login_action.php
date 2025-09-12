<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . "/../config.php";

$email = trim($_POST['email'] ?? '');
$pass  = $_POST['password'] ?? '';

if (!$email || !$pass) {
    die("Veuillez remplir tous les champs.");
}

// Vérifier si l'utilisateur existe
$stmt = $pdo->prepare("SELECT * FROM users WHERE email = ? LIMIT 1");
$stmt->execute([$email]);
$user = $stmt->fetch();

if (!$user) {
    die("Email ou mot de passe incorrect.");
}

// Vérifier le mot de passe
if (!password_verify($pass, $user['password_hash'])) {
    die("Email ou mot de passe incorrect.");
}

// Stocker l'utilisateur en session
$_SESSION['user'] = [
    'id'         => $user['id'],
    'user_id'    => $user['user_id'],
    'nom_prenom' => $user['nom_prenom'],
    'username'   => $user['username'],
    'email'      => $user['email'],
    'role'       => $user['role'],
    'created_at' => $user['created_at']
];

// Redirection après connexion
header("Location: /dashboard/index.php");
exit;
