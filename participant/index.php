<?php
require_once "../config.php"; require_login();
$u = current_user(); if ($u['role']!=='participant' && $u['role']!=='admin') { http_response_code(403); die('Accès refusé'); }
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
      <span class="inline-block w-20 h-20 b-2-s"><img src="./formation_passer/logo bcc.png" alt="Logo BCC-Center" class="logo"></span>
      <span>BCC-Center</span>
    </a>
    <nav x-data="{open:false}" class="relative">
      <button class="md:hidden p-2 border rounded-xl" @click="open=!open" aria-label="Menu">
        ☰
      </button>
      <ul class="hidden md:flex gap-6 items-center">
        <li><a class="hover:text-indigo-600" href="/index.php">Accueil</a></li>
        <li><a class="hover:text-indigo-600" href="/formations.php">Formations</a></li>
        <li><a class="hover:text-indigo-600" href="/forum/index.php">Forum</a></li>
        <li><a class="hover:text-indigo-600" href="/auth/login.php">Connexion</a></li>
        <li><a class="hover:text-indigo-600" href="/auth/register.php">Créer un compte</a></li>
      </ul>
      <ul x-show="open" @click.away="open=false" class="md:hidden absolute right-0 mt-2 bg-white shadow rounded-xl p-3 space-y-2 w-56">
        <li><a class="block px-2 py-1 rounded hover:bg-gray-100" href="/index.php">Accueil</a></li>
        <li><a class="block px-2 py-1 rounded hover:bg-gray-100" href="/formations.php">Formations</a></li>
        <li><a class="block px-2 py-1 rounded hover:bg-gray-100" href="/forum/index.php">Forum</a></li>
        <li><a class="block px-2 py-1 rounded hover:bg-gray-100" href="/auth/login.php">Connexion</a></li>
        <li><a class="block px-2 py-1 rounded hover:bg-gray-100" href="/auth/register.php">Créer un compte</a></li>
      </ul>
    </nav>
  </div>
</header>
<main class="max-w-7xl mx-auto px-4 py-8">

<h1 class="text-2xl font-bold mb-4">Espace participant</h1>
<div class="grid md:grid-cols-2 gap-6">
  <div class="p-6 bg-white rounded-2xl border shadow">
    <h2 class="font-semibold mb-2">Déposer un exercice</h2>
    <form method="post" enctype="multipart/form-data" action="upload_exercice.php" class="grid gap-3">
      <input type="file" name="file" class="border rounded-xl p-2" required>
      <textarea name="comment" class="border rounded-xl p-2" placeholder="Commentaire (optionnel)"></textarea>
      <button class="px-4 py-2 bg-indigo-600 text-white rounded-xl">Envoyer</button>
    </form>
  </div>
  <div class="p-6 bg-white rounded-2xl border shadow">
    <h2 class="font-semibold mb-2">Consignes à télécharger</h2>
    <ul class="list-disc ms-6 text-sm">
      <li><a class="text-indigo-600" href="/formateur/listes_consigne.php">Exemple de consigne</a></li>
    </ul>
  </div>
</div>
<div class="grid md:grid-cols-3 gap-6 mt-6">
  <a href="/qcm/index.php" class="p-6 bg-white rounded-2xl border shadow">QCM</a>
  <a href="/notes/index.php" class="p-6 bg-white rounded-2xl border shadow">Notes & Badges</a>
  <a href="/attestations/index.php" class="p-6 bg-white rounded-2xl border shadow">Attestation</a>
</div>
</main>
<footer class="border-t mt-12">
  <div class="max-w-7xl mx-auto px-4 py-6 text-sm text-gray-600 flex flex-wrap gap-4 justify-between">
    <span>© 2025 BCC-Center</span>
    <div class="space-x-4">
      <a href="/about.php" class="hover:text-indigo-600">À propos</a>
      <a href="/contact.php" class="hover:text-indigo-600">Contact</a>
      <a href="/legal.php" class="hover:text-indigo-600">Mentions légales</a>
    </div>
  </div>
</footer>
</body>
</html>
