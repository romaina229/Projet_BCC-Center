<?php
require_once "../config.php"; require_login();
$u = current_user();

if (!isset($_FILES['file'])) { die("Aucun fichier."); }
$dir = __DIR__ . "/..storage/exercices/" . intval($u['id']);
if (!is_dir($dir)) { mkdir($dir, 0777, true); }
$basename = basename($_FILES['file']['name']);
$target = $dir . "/" . time() . "_" . preg_replace('/[^a-zA-Z0-9._-]/','_', $basename);

if (move_uploaded_file($_FILES['file']['tmp_name'], $target)) {
  // Save record
  require_once "../utils/db.php";
  $stmt = $pdo->prepare("INSERT INTO exercices (user_id, path, comment) VALUES (?,?,?)");
  $stmt->execute([$u['id'], str_replace(__DIR__ . '/../', '/', $target), $_POST['comment'] ?? null]);
  header("Location: /participant/index.php");
} else {
  echo "Erreur lors de l'upload.";
}
