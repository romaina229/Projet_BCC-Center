<?php
require_once "../config.php"; 
require_login();

$user = current_user();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $full_name = trim($_POST['full_name']);
    $email     = trim($_POST['email']);
    $phone     = trim($_POST['phone']);
    $address   = trim($_POST['address']);
    $bio       = trim($_POST['bio']);

    // Photo
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

    $stmt = $pdo->prepare("UPDATE users SET full_name=?, email=?, phone=?, address=?, bio=?, photo=? WHERE id=?");
    $stmt->execute([$full_name, $email, $phone, $address, $bio, $photo, $user['id']]);

    header("Location: profile.php?success=1");
    exit;
}

// Rafraîchir les infos utilisateur
$stmt = $pdo->prepare("SELECT * FROM users WHERE id=?");
$stmt->execute([$user['id']]);
$user = $stmt->fetch();
?>
<!doctype html>
<html lang="fr">
<head>
<meta charset="utf-8">
<title>Mon profil - BCC-Center</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-900">

<!-- HEADER -->
<header class="sticky top-0 z-40 bg-white/80 backdrop-blur border-b">
  <div class="max-w-7xl mx-auto px-4 py-3 flex items-center justify-between">
    <a href="/index.php" class="flex items-center gap-2 font-semibold">
      <span class="inline-block w-8 h-8 rounded-2xl bg-indigo-600"></span>
      <span>BCC-Center</span>
    </a>
    <nav>
      <ul class="flex gap-6 items-center">
        <li><a class="hover:text-indigo-600" href="/participant/index.php">Formations</a></li>
        <li><a class="hover:text-indigo-600" href="/auth/users.php">Utilisateurs</a></li>
        <li><a class="hover:text-red-600" href="/auth/logout.php">Déconnexion</a></li>
      </ul>
    </nav>
  </div>
</header>

<!-- MAIN -->
<main class="max-w-2xl mx-auto px-4 py-8">
  <h1 class="text-2xl font-bold mb-6">Mon profil</h1>

  <?php if (!empty($_GET['success'])): ?>
    <p class="bg-green-100 text-green-700 p-3 rounded mb-4">Profil mis à jour avec succès</p>
  <?php endif; ?>

  <form method="post" enctype="multipart/form-data" class="bg-white shadow rounded-2xl p-6 grid gap-4">
    <div>
      <label class="block text-sm font-medium">Nom complet</label>
      <input type="text" name="full_name" value="<?= htmlspecialchars($user['full_name'] ?? '') ?>" class="border rounded-xl p-2 w-full">
    </div>
    <div>
      <label class="block text-sm font-medium">Email</label>
      <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" class="border rounded-xl p-2 w-full" required>
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
    <button class="bg-indigo-600 text-white px-4 py-2 rounded-xl">Sauvegarder</button>
  </form>
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
