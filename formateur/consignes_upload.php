<?php
require_once "../config.php"; require_login(); require_role('formateur');
if (!isset($_FILES['file'])) { die("Aucun fichier."); }
$dir = __DIR__ . "/../storage/consignes";
if (!is_dir($dir)) { mkdir($dir, 0777, true); }
$basename = basename($_FILES['file']['name']);
$target = $dir . "/" . time() . "_" . preg_replace('/[^a-zA-Z0-9._-]/','_', $basename);
if (move_uploaded_file($_FILES['file']['tmp_name'], $target)) {
  $stmt = $pdo->prepare("INSERT INTO consignes (title, path, created_by) VALUES (?,?,?)");
  $stmt->execute([$_POST['title'], str_replace(__DIR__ . '/../', '/', $target), current_user()['id']]);
  header("Location: /formateur/consignes.php");
} else { echo "Erreur upload."; } else {echo "Fichier publié avec succès.";}