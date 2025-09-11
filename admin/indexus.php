<?php
require_once "../config.php"; require_login(); require_role('admin');
$users = $pdo->query("SELECT id, name, email, role FROM users ORDER BY id DESC")->fetchAll();
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
      <ul class="hidden md:flex gap-6 items-center">
        <li><a class="hover:text-indigo-600" href="/index.php">Accueil</a></li>
        <?php if (current_user()['role'] === 'admin'): ?>
            <li><a class="hover:text-indigo-600" href="./auth/user.php">Utilisateurs</a></li>
          <?php endif; ?>
        <li><a class="hover:text-indigo-600" href="/formations.php">Formations</a></li>
        <li><a class="hover:text-indigo-600" href="/formation_passer/index.php">Espace programme</a></li>
        <li><a class="hover:text-indigo-600" href="/forum/index.php">Forum</a></li>
        <li><a class="hover:text-indigo-600" href="/auth/login.php">Connexion</a></li>
        <li><a class="hover:text-indigo-600" href="/auth/register.php">Créer un compte</a></li>
      </ul>
      <ul x-show="open" @click.away="open=false" class="md:hidden absolute right-0 mt-2 bg-white shadow rounded-xl p-3 space-y-2 w-56">
        <li><a class="block px-2 py-1 rounded hover:bg-gray-100" href="/index.php">Accueil</a></li>
        <?php if (current_user()['role'] === 'admin'): ?>
            <li><a class="hover:text-indigo-600" href="./auth/user.php">Utilisateurs</a></li>
          <?php endif; ?>
        <li><a class="block px-2 py-1 rounded hover:bg-gray-100" href="/formations.php">Formations</a></li>
        <li><a class="hover:text-indigo-600" href="/formation_passer/index.php">Espace programme</a></li>
        <li><a class="block px-2 py-1 rounded hover:bg-gray-100" href="/forum/index.php">Forum</a></li>
        <li><a class="block px-2 py-1 rounded hover:bg-gray-100" href="/auth/login.php">Connexion</a></li>
        <li><a class="block px-2 py-1 rounded hover:bg-gray-100" href="/auth/register.php">Créer un compte</a></li>
      </ul>
    </nav>
  </div>
</header>
<main class="max-w-7xl mx-auto px-4 py-8">

<h1 class="text-2xl font-bold mb-4">Administration</h1>
<section class="bg-white rounded-2xl border shadow p-6">
  <h2 class="font-semibold mb-3">Utilisateurs</h2>
  <table class="w-full text-sm">
    <thead><tr><th class="p-2 text-left">Nom</th><th class="p-2 text-left">Email</th><th class="p-2 text-left">Rôle</th></tr></thead>
    <tbody>
      <?php foreach($users as $u): ?>
      <tr class="border-t">
        <td class="p-2"><?php echo htmlspecialchars($u['name']); ?></td>
        <td class="p-2"><?php echo htmlspecialchars($u['email']); ?></td>
        <td class="p-2"><?php echo htmlspecialchars($u['role']); ?></td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
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
