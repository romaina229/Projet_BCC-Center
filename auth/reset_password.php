<?php include 'header.php'; require 'config.php';
$token = $_GET['token'] ?? '';
$stmt = $pdo->prepare("SELECT * FROM users WHERE reset_token = ?");
$stmt->execute([$token]);
$user = $stmt->fetch();
if (!$user) { echo "Lien invalide."; include 'footer.php'; exit; }
?>
<h2 class="text-xl font-bold mb-4">Réinitialiser le mot de passe</h2>
<form method="post" action="reset_password_action.php" class="space-y-4">
    <input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>">
    <input type="password" name="new_password" placeholder="Nouveau mot de passe" required class="border p-2 w-full">
    <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Réinitialiser</button>
</form>
<?php include 'footer.php'; ?>