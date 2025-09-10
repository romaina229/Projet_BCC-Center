<?php
require "../config.php";
if ($_SESSION['role'] !== 'formateur') die("Accès refusé");
if (isset($_POST['formation_id'])) {
    $stmt = $pdo->prepare("INSERT INTO qcm (formation_id, titre, seuil_reussite) VALUES (?, ?, ?)");
    $stmt->execute([$_POST['formation_id'], $_POST['titre'], $_POST['seuil']]);
    echo "QCM créé.";
}
$stmt = $pdo->prepare("SELECT id, titre FROM formations WHERE formateur_id = ?");
$stmt->execute([$_SESSION['id']]);
$formations = $stmt->fetchAll();
?>
<form method="POST">
    Formation: <select name="formation_id">
    <?php foreach ($formations as $f): ?>
        <option value="<?= $f['id'] ?>"><?= $f['titre'] ?></option>
    <?php endforeach; ?>
    </select><br>
    Titre QCM: <input type="text" name="titre" required><br>
    Seuil (%): <input type="number" name="seuil" value="65"><br>
    <button type="submit">Créer</button>
</form>