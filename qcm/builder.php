<?php
require_once __DIR__ . "/../config.php"; 
require_login(); 
if(!in_array(current_user()['role'], ['formateur','admin'])){
    die('Accès refusé : vous devez être formateur ou administrateur pour créer un QCM.');
}
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
      <span class="inline-block w-8 h-8"><img src="../assets/images/logo bcc.png" alt="Logo BCC-Center" class="logo"></span>
      <span>BCC-Center</span>
    </a>
    <nav x-data="{open:false}" class="relative">
      <button class="md:hidden p-2 border rounded-xl" @click="open=!open" aria-label="Menu">☰</button>
      <ul class="hidden md:flex gap-6 items-center">
        <li><a class="hover:text-indigo-600" href="../index.php">Accueil</a></li>
        <li><a class="hover:text-indigo-600" href="../formations.php">Formations</a></li>
        <li><a class="hover:text-indigo-600" href="../forum/index.php">Forum</a></li>
        <li><a class="hover:text-indigo-600" href="../auth/login.php">Connexion</a></li>
        <li><a class="hover:text-indigo-600" href="../auth/register.php">Créer un compte</a></li>
      </ul>
      <ul x-show="open" @click.away="open=false" class="md:hidden absolute right-0 mt-2 bg-white shadow rounded-xl p-3 space-y-2 w-56">
        <li><a class="block px-2 py-1 rounded hover:bg-gray-100" href="../index.php">Accueil</a></li>
        <li><a class="block px-2 py-1 rounded hover:bg-gray-100" href="../formations.php">Formations</a></li>
        <li><a class="block px-2 py-1 rounded hover:bg-gray-100" href="../forum/index.php">Forum</a></li>
        <li><a class="block px-2 py-1 rounded hover:bg-gray-100" href="../auth/login.php">Connexion</a></li>
        <li><a class="block px-2 py-1 rounded hover:bg-gray-100" href="../auth/register.php">Créer un compte</a></li>
      </ul>
    </nav>
  </div>
</header>

<main class="max-w-7xl mx-auto px-4 py-8">
<h1 class="text-2xl font-bold mb-4">Créer un QCM</h1>

<form method="post" action="builder_save.php" class="bg-white rounded-2xl border p-6 grid gap-3 max-w-2xl">
  <input name="title" class="border rounded-xl p-3" placeholder="Titre du QCM" required>
  
  <input type="text" name="questions_file" class="border rounded-xl p-3" placeholder="Nom du fichier JSON (ex: questions.json)" required>
  <p class="text-sm mt-1 text-gray-500">Astuce: le fichier doit exister sur le serveur dans le même dossier que ce formulaire.</p>
  
  <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-xl">Enregistrer</button>
</form>
</main>
<footer class="border-t mt-12">
  <div class="max-w-7xl mx-auto px-4 py-6 text-sm text-gray-600 flex flex-wrap gap-4 justify-between">
    <span>© 2025 BCC-Center</span>
    <div class="space-x-4">
      <a href="../about.php" class="hover:text-indigo-600">À propos</a>
      <a href="../contact.php" class="hover:text-indigo-600">Contact</a>
      <a href="../legal.php" class="hover:text-indigo-600">Mentions légales</a>
    </div>
  </div>
</footer>
</body>
</html>
