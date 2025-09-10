<?php
// Configuration base de données (adapter à votre hébergeur)
$DB_HOST = getenv('DB_HOST') ?: 'sql311_39863991';
$DB_NAME = getenv('DB_NAME') ?: 'b12_39863991_formation';
$DB_USER = getenv('DB_USER') ?: 'b12_39863991';
$DB_PASS = getenv('DB_PASS') ?: 'BCC@2025';
$DB_CHARSET = 'utf8mb4';

$dsn = "mysql:host=$DB_HOST;dbname=$DB_NAME;charset=$DB_CHARSET";
$options = [
  PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
  PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
  PDO::ATTR_EMULATE_PREPARES => false,
];

try {
  $pdo = new PDO($dsn, $DB_USER, $DB_PASS, $options);
} catch (PDOException $e) {
  http_response_code(500);
  echo "Erreur de connexion BD: " . htmlspecialchars($e->getMessage());
  exit;
}

session_start();

function require_login() {
  if (!isset($_SESSION['user'])) { header('Location: /auth/login.php'); exit; }
}
function current_user() { return $_SESSION['user'] ?? null; }
function require_role($role) {
  $u = current_user();
  if (!$u || $u['role'] !== $role) { http_response_code(403); echo "Vous n'êtes pas autorisé à cet espace, veuillez vérifier votre connexion pour d'autre espace. Merci!"; exit; }
}
// complement de connexion
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

try {
    $pdo = new PDO("mysql:host=localhost;dbname=bcc_center;charset=utf8", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    die("Erreur connexion BDD : " . $e->getMessage());
}

/**
 * Vérifie si un utilisateur est connecté
 */
function is_logged_in(): bool {
    return isset($_SESSION['user']);
}

/**
 * Retourne les infos de l’utilisateur connecté
 */
function current_user(): ?array {
    return $_SESSION['user'] ?? null;
}

/**
 * Oblige l’utilisateur à être connecté sinon redirige
 */
function require_login(): void {
    if (!is_logged_in()) {
        header("Location: /auth/login.php");
        exit;
    }
}
?>
