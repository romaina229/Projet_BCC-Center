<?php
require_once "../config.php"; require_login();
$u = current_user();
$notes = $pdo->prepare("SELECT n.score, e.path FROM notes n JOIN exercices e ON e.id=n.exercice_id WHERE n.user_id=? ORDER BY n.id DESC");
$notes->execute([$u['id']]);
$notes = $notes->fetchAll();
$badges = $pdo->prepare("SELECT label FROM badges WHERE user_id=?");
$badges->execute([$u['id']]);
$badges = $badges->fetchAll();
?>
<!doctype html>
<html lang="fr">
<head>
<meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
<title>BCC-Center</title>
<script src="https://cdn.tailwindcss.com"></script>
<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>
<body class="bg-gray-50 text-gray-900">
<header class="sticky top-0 z-40 bg-white/80 backdrop-blur border-b">
  <div class="max-w-7xl mx-auto px-4 py-3 flex items-center justify-between">
    <a href="/index.php" class="flex items-center gap-2 font-semibold">
      <span class="inline-block w-8 h-8 rounded-2xl bg-indigo-600"><img src="/assets/images/logo bcc.png" alt="Logo BCC-Center" class="logo"></span>
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
<div class="bg-white rounded-2xl border shadow p-6">
  <h2 class="font-semibold mb-3">Badges</h2>
  <div class="flex flex-wrap gap-2">
    <?php foreach($badges as $b): ?>
      <?php
        $icon = '';
        if ($b['label'] === 'Excellent') {
          // Icône étoile (Heroicons)
          $icon = '<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline" fill="gold" viewBox="0 0 24 24"><path d="M12 .587l3.668 7.571 8.332 1.151-6.064 5.795 1.548 8.312L12 18.896l-7.484 4.52 1.548-8.312L0 9.309l8.332-1.151z"/></svg>';
        } elseif ($b['label'] === 'Médiocre') {
          // Icône pouce vers le bas (Font Awesome exemple)
          $icon = '<i class="fas fa-thumbs-down text-red-500"></i>';
        } else {
          // Badge générique
          $icon = '<i class="fas fa-certificate text-gray-500"></i>';
        }
      ?>
      <span class="px-3 py-1 rounded-full bg-indigo-100 text-indigo-700 text-sm flex items-center gap-1">
        <?php echo $icon; ?>
        <?php echo htmlspecialchars($b['label']); ?>
      </span>
    <?php endforeach; ?>
  </div>
</div>
</section>
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
