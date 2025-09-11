<?php
// === Configuration base de données ===
$DB_HOST = getenv('DB_HOST') ?: 'sql311.byethost12.com'; // adapte selon ton hébergeur
$DB_NAME = getenv('DB_NAME') ?: 'bcc_formation';
$DB_USER = getenv('DB_USER') ?: 'b12_39863991';
$DB_PASS = getenv('DB_PASS') ?: 'BCC@2025';
$DB_CHARSET = 'utf8mb4';

// === Connexion PDO ===
$dsn = "mysql:host=$DB_HOST;dbname=$DB_NAME;charset=$DB_CHARSET";
$options = [
  PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
  PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
  PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $DB_USER, $DB_PASS, $options);
} catch (PDOException $e) {
    http_response_code(500);
    die("Erreur connexion BDD : " . htmlspecialchars($e->getMessage()));
}

// === Session ===
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// === Fonctions utilitaires ===
function is_logged_in(): bool {
    return isset($_SESSION['user']);
}

function current_user(): ?array {
    return $_SESSION['user'] ?? null;
}

function require_login(): void {
    if (!is_logged_in()) {
        header("Location: ./auth/login.php");
        exit;
    }
}

function require_role(string $role): void {
    $u = current_user();
    if (!$u || $u['role'] !== $role) {
        http_response_code(403);
        echo "Vous n'êtes pas autorisé à cet espace, veuillez vérifier votre connexion.";
        exit;
    }
}
?>