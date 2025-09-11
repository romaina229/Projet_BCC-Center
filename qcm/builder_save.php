<?php
// Affichage complet des erreurs pour debug
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . "/../config.php"; 
require_login(); 

// Vérifier le rôle
if(!in_array(current_user()['role'], ['formateur','admin'])){
    die('Accès refusé : vous devez être formateur ou administrateur pour créer un QCM.');
}

// Récupérer le titre et le fichier JSON depuis le formulaire
$title = trim($_POST['title'] ?? '');
$questions_file = trim($_POST['questions_file'] ?? '');

// Vérifier que les champs sont remplis
if (!$title || !$questions_file) {
    die('Champs manquants vous devez fournir un titre et un fichier JSON.');
}

// Vérifier que le fichier JSON existe
if (!file_exists($questions_file)) {
    die("Fichier JSON introuvable sur le serveur : $questions_file");
}

// Lire le contenu du fichier JSON
$json = file_get_contents($questions_file);
if ($json === false) {
    die("Impossible de lire le fichier JSON : $questions_file");
}

// Vérifier que le JSON est valide
if (json_decode($json) === null) {
    die("Le fichier JSON est invalide !");
}

// Insérer dans la base de données
$stmt = $pdo->prepare("INSERT INTO quizzes (title, questions_json, created_by) VALUES (?,?,?)");
$stmt->execute([$title, $json, current_user()['id']]);

// Rediriger vers la liste des QCM
header("Location:../qcm/index.php");
exit;
