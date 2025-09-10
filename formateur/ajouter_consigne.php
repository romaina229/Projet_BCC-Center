<?php
require "../config.php";
if ($_SESSION['role'] !== 'formateur') die("Accès refusé");
if (isset($_POST['formation_id'])) {
    $target_dir = "../storage/consignes/";
    $file_name = basename($_FILES["fichier"]["name"]);
    $target_file = $target_dir . time() . "_" . $file_name;
    move_uploaded_file($_FILES["fichier"]["tmp_name"], $target_file);
    $stmt = $pdo->prepare("INSERT INTO consignes (formation_id, fichier) VALUES (?, ?)");
    $stmt->execute([$_POST['formation_id'], $target_file]);
    echo "Consigne ajoutée.";
}
$stmt = $pdo->prepare("SELECT id, titre FROM formations WHERE formateur_id = ?");
$stmt->execute([$_SESSION['id']]);
$formations = $stmt->fetchAll();
?>
<form method="POST" enctype="multipart/form-data">
    Formation: <select name="formation_id">
    <?php foreach ($formations as $f): ?>
        <option value="<?= $f['id'] ?>"><?= $f['titre'] ?></option>
    <?php endforeach; ?>
    </select><br>
    Fichier: <input type="file" name="fichier" required><br>
    <button type="submit">Ajouter</button>
</form>