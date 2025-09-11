<?php
require_once __DIR__ . "/../config.php"; 
?>
 <!doctype html>
<html lang="fr">
<head>
<meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
<title>BCC-Center</title>
<script src="https://cdn.tailwindcss.com"></script>
<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gray-50 text-gray-900">
<header class="sticky top-0 z-40 bg-white/80 backdrop-blur border-b">
  <div class="max-w-7xl mx-auto px-4 py-3 flex items-center justify-between">
    <a href="/index.php" class="flex items-center gap-2 font-semibold">
      <span class="inline-block w-20 h-20 b-2-s"><img src="../assets/images/logo bcc.png" alt="Logo BCC-Center" class="logo"></span>
      <span>BCC-Center</span>
    </a>
    <nav x-data="{open:false}" class="relative">
      <button class="md:hidden p-2 border rounded-xl" @click="open=!open" aria-label="Menu">
        ☰
      </button>
      <!--comparaison file -->
      <ul class="hidden md:flex gap-6 items-center">
        <li><a class="hover:text-indigo-600" href="../index.php">Accueil</a></li>
        <li><a class="hover:text-indigo-600" href="../formations.php">Formations</a></li>
        <li><a class="hover:text-indigo-600" href="../forum/index.php">Forum</a></li>

        <?php if (is_logged_in()): ?>
          <li><a class="hover:text-indigo-600" href="../qcm/index.php">QCM</a></li>
          <li><a class="hover:text-indigo-600" href="/auth/profile.php">Mon profil</a></li>
          <li><a class="hover:text-indigo-600" href="/auth/profile1.php">Mise à jour profil</a></li>

          <?php if (current_user()['role'] === 'admin'): ?>
            <li><a class="hover:text-indigo-600" href="/auth/user.php">Utilisateurs</a></li>
          <?php endif; ?>

          <li><a class="hover:text-red-600" href="logout.php">Déconnexion</a></li>
        <?php else: ?>
          <li><a class="hover:text-indigo-600" href="login.php">Connexion</a></li>
          <li><a class="hover:text-indigo-600" href="register.php">Créer un compte</a></li>
        <?php endif; ?>
      </ul>      
      <ul x-show="open" @click.away="open=false" class="md:hidden absolute right-0 mt-2 bg-white shadow rounded-xl p-3 space-y-2 w-56">
        <li><a class="hover:text-indigo-600" href="../index.php">Accueil</a></li>
        <li><a class="hover:text-indigo-600" href="../formations.php">Formations</a></li>
        <li><a class="hover:text-indigo-600" href="../forum/index.php">Forum</a></li>

        <?php if (is_logged_in()): ?>
          <li><a class="hover:text-indigo-600" href="../qcm/index.php">QCM</a></li>
          <li><a class="hover:text-indigo-600" href="/auth/profile.php">Mon profil</a></li>
          <li><a class="hover:text-indigo-600" href="/auth/profile1.php">Mise à jour profil</a></li>

          <?php if (current_user()['role'] === 'admin'): ?>
            <li><a class="hover:text-indigo-600" href="/auth/user.php">Utilisateurs</a></li>
          <?php endif; ?>

          <li><a class="hover:text-red-600" href="logout.php">Déconnexion</a></li>
        <?php else: ?>
          <li><a class="hover:text-indigo-600" href="login.php">Connexion</a></li>
          <li><a class="hover:text-indigo-600" href="register.php">Créer un compte</a></li>
        <?php endif; ?>
    </nav>
  </div>
</header>
<main class="max-w-7xl mx-auto px-4 py-8">
<!--comparaison file -->
