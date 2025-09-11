<?php
require __DIR__ . '/../config.php';
require_login();

if (!in_array(current_user()['role'], ['admin'])) {
    die("⛔ Accès refusé");
}

$id = intval($_GET['id'] ?? 0);
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$id]);
$user = $stmt->fetch();

if (!$user) {
    die("Utilisateur introuvable");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $full_name = trim($_POST['full_name']);
    $email     = trim($_POST['email']);
    $role      = trim($_POST['role']);
    $phone     = trim($_POST['phone']);
    $address   = trim($_POST['address']);
    $bio       = trim($_POST['bio']);

    // Gestion de la photo
    $photo = $user['photo'];
    if (!empty($_FILES['photo']['name'])) {
        $upload_dir = "../uploads/";
        if (!is_dir($upload_dir)) mkdir($upload_dir, 0777, true);
        $filename = time() . "_" . basename($_FILES['photo']['name']);
        $target = $upload_dir . $filename;
        if (move_uploaded_file($_FILES['photo']['tmp_name'], $target)) {
            $photo = "/uploads/" . $filename;
        }
    }

    $stmt = $pdo->prepare("UPDATE users SET full_name=?, email=?, role=?, phone=?, address=?, bio=?, photo=? WHERE id=?");
    $stmt->execute([$full_name, $email, $role, $phone, $address, $bio, $photo, $id]);

    header("Location: users.php");
    exit;
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
        <?php if (is_logged_in()): ?>
          <li><a class="hover:text-indigo-600" href="profile.php">Mon profil</a></li>
          <li><a class="hover:text-indigo-600" href="profile1.php">Mise à jour profil</a></li>
          <?php if (current_user()['role'] === 'admin'): ?>
            <li><a class="hover:text-indigo-600" href="user.php">Utilisateurs</a></li>
          <?php endif; ?>
          <li><a class="hover:text-red-600" href="logout.php">Déconnexion</a></li>
        <?php else: ?>
      </ul>
      <ul x-show="open" @click.away="open=false" class="md:hidden absolute right-0 mt-2 bg-white shadow rounded-xl p-3 space-y-2 w-56">
        <li><a class="hover:text-indigo-600" href="../index.php">Accueil</a></li>
        <li><a class="hover:text-indigo-600" href="../formations.php">Formations</a></li>
        <li><a class="hover:text-indigo-600" href="../forum/index.php">Forum</a></li>
        <?php if (is_logged_in()): ?>
          <li><a class="hover:text-indigo-600" href="../qcm/index.php">QCM</a></li>
          <li><a class="hover:text-indigo-600" href="profile.php">Mon profil</a></li>
          <li><a class="hover:text-indigo-600" href="profile1.php">Mise à jour profil</a></li>
          <?php if (current_user()['role'] === 'admin'): ?>
            <li><a class="hover:text-indigo-600" href="user.php">Utilisateurs</a></li>
          <li><a class="hover:text-red-600" href="logout.php">Déconnexion</a></li>
        <?php else: ?>
          <?php endif; ?>
    </nav>
  </div>
</header>
<main class="max-w-7xl mx-auto px-4 py-8">
<!-- MAIN -->
<main class="max-w-2xl mx-auto px-4 py-8">
  <h1 class="text-2xl font-bold mb-6">Modifier l’utilisateur</h1>

  <form method="post" enctype="multipart/form-data" class="bg-white shadow rounded-2xl p-6 grid gap-4">
    <div>
      <label class="block text-sm font-medium">Nom complet</label>
      <input type="text" name="full_name" value="<?= htmlspecialchars($user['full_name']) ?>" class="border rounded-xl p-2 w-full" required>
    </div>
    <div>
      <label class="block text-sm font-medium">Email</label>
      <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" class="border rounded-xl p-2 w-full" required>
    </div>
    <div>
      <label class="block text-sm font-medium">Rôle</label>
      <select name="role" class="border rounded-xl p-2 w-full" required>
        <option value="participant" <?= $user['role']=='participant'?'selected':'' ?>>Participant</option>
        <option value="formateur" <?= $user['role']=='formateur'?'selected':'' ?>>Formateur</option>
        <option value="admin" <?= $user['role']=='admin'?'selected':'' ?>>Admin</option>
      </select>
    </div>
    <div>
      <label class="block text-sm font-medium">Téléphone</label>
      <input type="text" name="phone" value="<?= htmlspecialchars($user['phone'] ?? '') ?>" class="border rounded-xl p-2 w-full">
    </div>
    <div>
      <label class="block text-sm font-medium">Adresse</label>
      <input type="text" name="address" value="<?= htmlspecialchars($user['address'] ?? '') ?>" class="border rounded-xl p-2 w-full">
    </div>
    <div>
      <label class="block text-sm font-medium">Bio</label>
      <textarea name="bio" class="border rounded-xl p-2 w-full h-24"><?= htmlspecialchars($user['bio'] ?? '') ?></textarea>
    </div>
    <div>
      <label class="block text-sm font-medium">Photo de profil</label>
      <?php if ($user['photo']): ?>
        <img src="<?= htmlspecialchars($user['photo']) ?>" class="w-16 h-16 rounded-full mb-2 object-cover border">
      <?php endif; ?>
      <input type="file" name="photo" class="border rounded-xl p-2 w-full">
    </div>
    <button class="bg-indigo-600 text-white px-4 py-2 rounded-xl">💾 Enregistrer</button>
  </form>
</main>

<!-- FOOTER -->
<footer class="border-t mt-12">
  <div class="max-w-7xl mx-auto px-4 py-6 text-sm text-gray-600 flex flex-wrap gap-4 justify-between">
    <span>Adresse : Abomey-Calavi, Bénin<br>Téléphone : +229 01 40 15 24 43<br>Contact : <a href="mailto:boostagecenter@gmail.com" class="hover:text-indigo-600"> courrier électronique</a><br>© 2025 BCC-Center - Tous droits réservés</span>
    <div class="space-x-4">
      <a href="../about.php" class="hover:text-indigo-600">À propos</a>
      <a href="../contact.php" class="hover:text-indigo-600">Contact</a>
      <a href="../legal.php" class="hover:text-indigo-600">Mentions légales</a>
    </div>
  </div>
</footer>

</body>
</html>
