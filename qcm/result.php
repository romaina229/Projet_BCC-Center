<?php
require_once "../config.php"; 
require_login();

$id = intval($_GET['id'] ?? 0);
$score = intval($_GET['score'] ?? 0);
$total = intval($_GET['total'] ?? 0);

$stmt = $pdo->prepare("SELECT * FROM quizzes WHERE id=?");
$stmt->execute([$id]);
$quiz = $stmt->fetch();

if (!$quiz) die("QCM introuvable");

$questions = json_decode($quiz['questions_json'], true);
?>
<!doctype html>
<html lang="fr">
<head>
<meta charset="utf-8">
<title>Résultat - <?= htmlspecialchars($quiz['title']) ?> - BCC-Center</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="https://cdn.tailwindcss.com"></script>
<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-gray-50 text-gray-900">
<!-- HEADER -->
<header class="sticky top-0 z-40 bg-white/80 backdrop-blur border-b">
  <div class="max-w-7xl mx-auto px-4 py-3 flex items-center justify-between">
    <a href="/index.php" class="flex items-center gap-2 font-semibold">
      <span class="inline-block w-8 h-8 rounded-2xl bg-indigo-600"></span>
      <span>BCC-Center</span>
    </a>
    <nav x-data="{open:false}" class="relative">
      <button class="md:hidden p-2 border rounded-xl" @click="open=!open" aria-label="Menu">☰</button>
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
  <h1 class="text-2xl font-bold mb-4">Résultats : <?= htmlspecialchars($quiz['title']) ?></h1>
  <p class="mb-6">Votre score : <strong><?= $score ?>/<?= $total ?></strong></p>

  <div class="space-y-6">
  <?php foreach ($questions as $i => $q): ?>
    <div class="bg-white p-4 rounded-xl shadow">
      <p class="font-semibold mb-2"><?= ($i+1) ?>. <?= htmlspecialchars($q['question']) ?></p>
      <p class="text-green-600">✅ Bonne réponse : <?= htmlspecialchars($q['options'][$q['answer']]) ?></p>
      <p class="text-gray-600 italic">💡 Explication : <?= htmlspecialchars($q['explanation'] ?? "Pas d'explication fournie") ?></p>
    </div>
  <?php endforeach; ?>
  </div>
</main>

<!-- FOOTER -->
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
