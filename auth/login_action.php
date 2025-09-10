<?php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['users_id'] = $user['id'];
        $_SESSION['nom_prenom'] = $user['nom_prenom'];
        $_SESSION['email'] = $user['email'];
        header("Location: index.php");
        exit;
    } else {
        echo "Identifiants incorrects.";
    }
}
?>