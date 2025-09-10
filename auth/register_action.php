<?php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = $_POST['user'];
	$nom_prenom = $_POST['nom_prenom'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $stmt = $pdo->prepare("INSERT INTO users (username, nom_prenom, email, password) VALUES (?, ?, ?)");
    $stmt->execute([$username, $nom_prenom, $email, $password]);

    header("Location: login.php");
    exit;
}
?>