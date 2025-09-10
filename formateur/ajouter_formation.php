<?php
require "../config.php";
if ($_SESSION['role'] !== 'formateur') die("Accès refusé");
if (isset($_POST['titre'])) {
    $stmt = $pdo->prepare("INSERT INTO formations (titre, description, formateur_id) VALUES (?, ?, ?)");
    $stmt->execute([$_POST['titre'], $_POST['description'], $_SESSION['id']]);
    echo "Formation créée avec succès !";
}
?>
<form method="POST" onsubmit="return validateForm()">
    Titre: <input type="text" name="titre" required><br>
    Description:<br>
    <textarea name="description" required></textarea><br>
    <button type="submit">Créer</button>
</form>
<script>
    fonction validateForm() {
        const titre = document.querySelector('input[name="titre"]').value;
        const description = document.querySelector('textarea[name="description"]').value;
        if (titre.length < 5) {
            alert("Le titre doit contenir au moins 5 caractères.");
            return false;
        }
        if (description.length < 10) {
            alert("La description doit contenir au moins 10 caractères.");
            return false;
        }
        return true;
        echo {" formation créée avec succès ! "}
    }
</script>