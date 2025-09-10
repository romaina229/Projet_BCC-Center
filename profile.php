<?php include 'header.php'; require 'config.php';
if (!isset($_SESSION['user_id'])) { header("Location: login.php"); exit; }
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch();
?>
<h2 class="text-xl font-bold mb-4">Mon Profil</h2>
<form method="post" action="profile_update.php" enctype="multipart/form-data" class="space-y-4">
    <input type="text" name="fullname" value="<?= htmlspecialchars($user['fullname']) ?>" required class="border p-2 w-full">
    <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required class="border p-2 w-full">
    <input type="text" name="address" placeholder="Adresse complète" value="<?= htmlspecialchars($user['address'] ?? '') ?>" class="border p-2 w-full">
    <input type="file" name="profile_picture" class="border p-2 w-full">
    <?php if (!empty($user['profile_picture'])): ?>
        <img src="uploads/<?= htmlspecialchars($user['profile_picture']) ?>" alt="Photo de profil" class="h-20 mt-2">
    <?php endif; ?>
    <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Mettre à jour</button>
</form>
<?php include 'footer.php'; ?>