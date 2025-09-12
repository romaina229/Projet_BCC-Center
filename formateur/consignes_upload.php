<?php
require_once __DIR__ . "/../config.php"; 
require_login(); 
require_role('formateur');

if (!isset($_FILES['file']) || $_FILES['file']['error'] !== UPLOAD_ERR_OK) {
    die("Aucun fichier ou erreur d'upload.");
}

$dir = __DIR__ . "/../storage/consignes";
if (!is_dir($dir)) { mkdir($dir, 0777, true); }

$basename = basename($_FILES['file']['name']);
$target = $dir . "/" . time() . "_" . preg_replace('/[^a-zA-Z0-9._-]/','_', $basename);

if (move_uploaded_file($_FILES['file']['tmp_name'], $target)) {

    // Préparer les valeurs pour l'insertion
    $formation_id = $_POST['formation_id'] ?? 0;
    $title        = $_POST['title'] ?? $basename;
    $path         = str_replace(__DIR__ . '/../', '/', $target);
    $fichier      = $basename;
    $created_by   = current_user()['id'];
    $created_at   = date('Y-m-d H:i:s');

    // Insertion en base
    $stmt = $pdo->prepare("
        INSERT INTO consignes (formation_id, title, path, fichier, created_by, created_at)
        VALUES (?,?,?,?,?,?)
    ");
    $stmt->execute([$formation_id, $title, $path, $fichier, $created_by, $created_at]);
    // Ou redirection
    $_SESSION['upload_message'] = "Fichier publié avec succès !";
    header("Location: consignes.php");
    exit;

} else {
    $_SESSION['upload_message'] = "Erreur lors de l'upload du fichier.";
    header("Location: consignes.php");
    exit;
}