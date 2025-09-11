<?php
require_once __DIR__ . "/../config.php";
$id = intval($_GET['id'] ?? 0);
$stmt = $pdo->prepare("SELECT f.*, u.name as author FROM forum_threads f JOIN users u ON u.id=f.user_id WHERE f.id=?");
$stmt->execute([$id]);
$thread = $stmt->fetch();
if (!$thread) { http_response_code(404); die("Sujet introuvable"); }
$posts = $pdo->prepare("SELECT p.*, u.name as author FROM forum_posts p JOIN users u ON u.id=p.user_id WHERE p.thread_id=? ORDER BY p.id ASC");
$posts->execute([$id]);
$posts = $posts->fetchAll();
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
      <button class="md:hidden p-2 border rounded-xl" @click="open=!open" aria-label="Menu">
        ☰
      </button>
      <ul class="hidden md:flex gap-6 items-center">
        <li><a class="hover:text-indigo-600" href="../index.php">Accueil</a></li>
        <li><a class="hover:text-indigo-600" href="../formations.php">Formations</a></li>
        <li><a class="hover:text-indigo-600" href="/forum/index.php">Forum</a></li>
        <li><a class="hover:text-indigo-600" href="../auth/login.php">Connexion</a></li>
        <li><a class="hover:text-indigo-600" href="../auth/register.php">Créer un compte</a></li>
      </ul>
      <ul x-show="open" @click.away="open=false" class="md:hidden absolute right-0 mt-2 bg-white shadow rounded-xl p-3 space-y-2 w-56">
        <li><a class="block px-2 py-1 rounded hover:bg-gray-100" href="../index.php">Accueil</a></li>
        <li><a class="block px-2 py-1 rounded hover:bg-gray-100" href="../formations.php">Formations</a></li>
        <li><a class="block px-2 py-1 rounded hover:bg-gray-100" href="/forum/index.php">Forum</a></li>
        <li><a class="block px-2 py-1 rounded hover:bg-gray-100" href="../auth/login.php">Connexion</a></li>
        <li><a class="block px-2 py-1 rounded hover:bg-gray-100" href="../auth/register.php">Créer un compte</a></li>
      </ul>
    </nav>
  </div>
</header>
<main class="max-w-7xl mx-auto px-4 py-8">

<h1 class="text-2xl font-bold mb-2"><?php echo htmlspecialchars($thread['title']); ?></h1>
<p class="text-sm text-gray-600 mb-6">par <?php echo htmlspecialchars($thread['author']); ?></p>
<div class="bg-white rounded-2xl border shadow p-6 mb-6">
  <p class="whitespace-pre-wrap"><?php echo nl2br(htmlspecialchars($thread['body'])); ?></p>
</div>
<section class="space-y-3">
  <?php foreach($posts as $p): ?>
  <div class="bg-white rounded-2xl border shadow p-4">
    <div class="text-sm text-gray-600 mb-2">par <?php echo htmlspecialchars($p['author']); ?></div>
    <div class="whitespace-pre-wrap"><?php echo nl2br(htmlspecialchars($p['body'])); ?></div>
  </div>
  <?php endforeach; ?>
</section>
<?php if(current_user()): ?>
<form method="post" action="reply_action.php" class="bg-white rounded-2xl border p-4 grid gap-3 mt-6">
  <input type="hidden" name="thread_id" value="<?php echo intval($thread['id']); ?>">
  <textarea name="body" class="border rounded-xl p-3" placeholder="Répondre..." required></textarea>
  <button class="px-4 py-2 bg-indigo-600 text-white rounded-xl">Envoyer</button>
</form>
<?php endif; ?>
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
