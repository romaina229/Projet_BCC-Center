<?php
require __DIR__ . '/../config.php';
if ($_SESSION['role'] !== 'formateur') die("Accès refusé");
if (isset($_POST['qcm_id']) && isset($_POST['question'])) {
    $stmt = $pdo->prepare("INSERT INTO questions (qcm_id, question) VALUES (?, ?)");
    $stmt->execute([$_POST['qcm_id'], $_POST['question']]);
    $qid = $pdo->lastInsertId();
    foreach ($_POST['reponse'] as $i => $rep) {
        $correcte = ($_POST['correcte'] == $i) ? 1 : 0;
        $stmt = $pdo->prepare("INSERT INTO reponses (question_id, reponse, correcte) VALUES (?, ?, ?)");
        $stmt->execute([$qid, $rep, $correcte]);
    }
    echo "Question ajoutée.";
}
$stmt = $pdo->prepare("SELECT q.id, q.titre, f.titre AS formation FROM qcm q JOIN formations f ON q.formation_id=f.id WHERE f.formateur_id=?");
$stmt->execute([$_SESSION['id']]);
$qcms = $stmt->fetchAll();
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
<form method="POST">
    QCM: <select name="qcm_id">
    <?php foreach ($qcms as $q): ?>
        <option value="<?= $q['id'] ?>"><?= $q['formation'] ?> - <?= $q['titre'] ?></option>
    <?php endforeach; ?>
    </select><br>
    Question:<br><textarea name="question" class="px-4 py-2 bg-indigo-600 text-white rounded-xl" required></textarea><br>
    Réponses:<br>
    <input type="text" name="reponse[]" placeholder="Réponse 1" class="border rounded-xl p-3" required><br>
    <input type="text" name="reponse[]" placeholder="Réponse 2" class="border rounded-xl p-3" required><br>
    <input type="text" name="reponse[]" placeholder="Réponse 3" class="border rounded-xl p-3"><br>
    <input type="text" name="reponse[]" placeholder="Réponse 4" class="border rounded-xl p-3"><br>
    Bonne réponse:<br>
    <select name="correcte">
        <option value="0" class="border rounded-xl p-3">Réponse 1</option>
        <option value="1" class="border rounded-xl p-3">Réponse 2</option>
    </select><br>
    <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-xl">Ajouter Question</button>
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