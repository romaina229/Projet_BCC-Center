<?php
require_once "../config.php";
require_login();

$user = current_user();
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
      <p><strong>Nom complet :</strong> <?= htmlspecialchars($user['full_name']) ?></p>
      <p><strong>Email :</strong> <?= htmlspecialchars($user['email']) ?></p>
      <p><strong>Rôle :</strong> <?= htmlspecialchars($user['role']) ?></p>
    </div>
  </main>

  <?php require_once "footer.php"; ?>
</body>
</html>
