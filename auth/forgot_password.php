<?php include 'header.php'; ?>
<h2 class="text-xl font-bold mb-4">Mot de passe oublié</h2>
<form method="post" action="forgot_password_action.php" class="space-y-4">
    <input type="email" name="email" placeholder="Votre email" required class="border p-2 w-full">
    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Envoyer le lien</button>
</form>
<?php include 'footer.php'; ?>