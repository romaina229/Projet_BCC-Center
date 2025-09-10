<?php
require_once "../config.php";
require_login();

$users = current_users();
?>
<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <title>Profil</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
  <?php require_once "header.php"; ?>

  <main class="max-w-4xl mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-4">Mon profil</h1>

    <div class="bg-white p-6 rounded-2xl shadow border">
      <p><strong>Photo de profil :</strong> <img src="<?= htmlspecialchars($users['photo']) ?>" alt="Photo de profil" class="w-16 h-16 rounded-full object-cover border"></p>
      <p><strong>Nom complet :</strong> <?= htmlspecialchars($users['nom_prenom']) ?></p>
      <p><strong>Bio :</strong> <?= htmlspecialchars($users['bio']) ?></p>
      <p><strong>Email :</strong> <?= htmlspecialchars($users['email']) ?></p>
      <p><strong>Rôle :</strong> <?= htmlspecialchars($users['role']) ?></p>
    </div>
  </main>

  <?php require_once "footer.php"; ?>
</body>
</html>
