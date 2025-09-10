<?php
require "../config.php";
if ($_SESSION['role'] !== 'formateur') die("Accès refusé");
if (isset($_POST['titre'])) {
    $stmt = $pdo->prepare("INSERT INTO formations (titre, description, formateur_id) VALUES (?, ?, ?)");
    $stmt->execute([$_POST['titre'], $_POST['description'], $_SESSION['id']]);
    echo "Formation créée avec succès !";
}
?>
<form method="POST">
    Titre: <input type="text" name="titre" required><br>
    Description:<br>
    <textarea name="description" required></textarea><br>
    <button type="submit">Créer</button>
</form>