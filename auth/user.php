<?php
require __DIR__ . '/../config.php'; 
require_login();

if (!in_array(current_user()['role'], ['admin'])) {
    die("⛔ Accès refusé ⛔ vous n'etes autorisé à accéder à cette page");
}

$stmt = $pdo->query("SELECT * FROM users ORDER BY created_at DESC");
$users = $stmt->fetchAll();
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
          <li><a class="hover:text-indigo-600" href="profile.php">Mon profil</a></li>
          <li><a class="hover:text-indigo-600" href="profile1.php">Mise à jour profil</a></li>
            <li><a class="hover:text-indigo-600" href="user.php">Utilisateurs</a></li>
          <li><a class="hover:text-red-600" href="logout.php">Déconnexion</a></li>
      </ul>
      <ul x-show="open" @click.away="open=false" class="md:hidden absolute right-0 mt-2 bg-white shadow rounded-xl p-3 space-y-2 w-56">
        <li><a class="hover:text-indigo-600" href="../index.php">Accueil</a></li>
        <li><a class="hover:text-indigo-600" href="../formations.php">Formations</a></li>
        <li><a class="hover:text-indigo-600" href="../forum/index.php">Forum</a></li>
          <li><a class="hover:text-indigo-600" href="../qcm/index.php">QCM</a></li>
          <li><a class="hover:text-indigo-600" href="profile.php">Mon profil</a></li>
          <li><a class="hover:text-indigo-600" href="profile1.php">Mise à jour profil</a></li>
            <li><a class="hover:text-indigo-600" href="user.php">Utilisateurs</a></li>
          <li><a class="hover:text-red-600" href="logout.php">Déconnexion</a></li>
    </nav>
  </div>
</header>
<main class="max-w-7xl mx-auto px-4 py-8">
  <h1 class="text-2xl font-bold mb-6">Liste des utilisateurs</h1>
  <div class="bg-white rounded-2xl shadow overflow-x-auto">
    <table class="w-full border-collapse">
      <thead class="bg-gray-100 text-left">
        <tr>
          <th class="p-3 border">Photo</th>
          <th class="p-3 border">Nom complet</th>
          <th class="p-3 border">Email</th>
          <th class="p-3 border">Rôle</th>
          <th class="p-3 border">Téléphone</th>
          <th class="p-3 border">Adresse</th>
          <th class="p-3 border">Bio</th>
          <th class="p-3 border">Inscription</th>
          <th class="p-3 border">Actions</th>
        </tr>
      </thead>
      <tbody>
          <tr class="hover:bg-gray-50">
            <td class="p-3 border text-center">
              <img src="<?= $u['photo'] ? htmlspecialchars($u['photo']) : '/default-avatar.png' ?>" 
                   class="w-12 h-12 rounded-full mx-auto object-cover border">
            </td>
            <td class="p-3 border"><?= htmlspecialchars($u['full_name'] ?? '') ?></td>
            <td class="p-3 border"><?= htmlspecialchars($u['email']) ?></td>
            <td class="p-3 border">
              <span class="px-2 py-1 rounded text-white text-sm 
                <?= $u['role']=='admin' ? 'bg-red-600' : ($u['role']=='formateur' ? 'bg-indigo-600' : 'bg-green-600') ?>">
                <?= htmlspecialchars($u['role']) ?>
              </span>
            </td>
            <td class="p-3 border"><?= htmlspecialchars($u['phone'] ?? '-') ?></td>
            <td class="p-3 border"><?= htmlspecialchars($u['address'] ?? '-') ?></td>
            <td class="p-3 border text-sm"><?= htmlspecialchars($u['bio'] ?? '-') ?></td>
            <td class="p-3 border text-gray-500 text-sm"><?= htmlspecialchars($u['created_at']) ?></td>
            <td class="p-3 border text-center">
              <a href="user_edit.php?id=<?= $u['id'] ?>" class="text-indigo-600 hover:underline">✏️ Modifier</a> |
              <a href="user_delete.php?id=<?= $u['id'] ?>" 
                 onclick="return confirm('Confirmer la suppression de cet utilisateur ?');"
                 class="text-red-600 hover:underline">🗑️ Supprimer</a>
            </td>
          </tr>
      </tbody>
    </table>
  </div>
</main>

<!-- FOOTER -->
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
