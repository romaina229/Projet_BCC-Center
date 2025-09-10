<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BCC-Center</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
<header class="bg-blue-800 text-white p-4 flex justify-between items-center">
    <div class="flex items-center">
        <img src="./formation_passer/logo bcc.png" alt="BCC-Center Logo" class="h-10 mr-3">
        <h1 class="text-xl font-bold">BCC-Center</h1>
    </div>
    <nav>
        <a href="index.php" class="mr-4">Accueil</a>
        <?php if(isset($_SESSION['user_id'])): ?>
            <a href="profile.php" class="mr-4">Mon profil</a>
            <a href="logout.php" class="mr-4">Déconnexion</a>
        <?php else: ?>
            <a href="login.php" class="mr-4">Connexion</a>
            <a href="register.php" class="mr-4">Inscription</a>
        <?php endif; ?>
    </nav>
</header>
<main class="p-6">