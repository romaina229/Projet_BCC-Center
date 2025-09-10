<?php
require_once "../config.php"; require_login(); require_role('formateur');
$stmt = $pdo->query("SELECT e.id, u.name, e.path, e.comment FROM exercices e JOIN users u ON u.id=e.user_id ORDER BY e.id DESC");
$rows = $stmt->fetchAll();
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
      <span class="inline-block w-8 h-8 rounded-2xl bg-indigo-600"></span>
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

<h1 class="text-2xl font-bold mb-4">Évaluer les exercices</h1>
<table class="w-full bg-white rounded-2xl border shadow">
  <thead><tr class="text-left">
    <th class="p-3">Participant</th><th class="p-3">Fichier</th><th class="p-3">Commentaire</th><th class="p-3">Note</th>
  </tr></thead>
  <tbody>
  <?php foreach($rows as $r): ?>
    <tr class="border-t">
      <td class="p-3"><?php echo htmlspecialchars($r['name']); ?></td>
      <td class="p-3"><a class="text-indigo-600" href="<?php echo htmlspecialchars($r['path']); ?>" target="_blank">Télécharger</a></td>
      <td class="p-3 text-sm"><?php echo htmlspecialchars($r['comment']); ?></td>
      <td class="p-3">
        <form method="post" action="/notes/note_save.php" class="flex gap-2">
          <input type="hidden" name="exercice_id" value="<?php echo intval($r['id']); ?>">
          <input type="number" name="score" min="0" max="100" class="border rounded-xl p-2 w-24" placeholder="Note">
          <button class="px-3 py-2 bg-indigo-600 text-white rounded-xl">Enregistrer</button>
        </form>
      </td>
    </tr>
  <?php endforeach; ?>
  </tbody>
</table>
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
