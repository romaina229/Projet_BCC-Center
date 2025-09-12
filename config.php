<?php
// Configuration base de données (adapter à votre hébergeur)
$DB_HOST = getenv('DB_HOST') ?: 'sql311.byethost12.com';
$DB_NAME = getenv('DB_NAME') ?: 'b12_39863991_bcc_formation';
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
  //forcer l'heure  MySQL en GMT+1 locale du Bénin
	$pdo->exec("SET time_zone = '+01:00'");
} catch (PDOException $e) {
  http_response_code(500);
  echo "Erreur de connexion BD: " . htmlspecialchars($e->getMessage());
  exit;
}

session_start();

function require_login() { if (!isset($_SESSION['user'])) { header('Location: /auth/login.php'); exit; } }

function current_user() { return $_SESSION['user'] ?? null; }
function require_role($role) {
  $user = current_user();
  if (!$user || $user['role'] !== $role) { http_response_code(403); echo "Accès refusé"; exit; }
}
?>
