<?php include 'header.php'; ?>
<h2 class="text-xl font-bold mb-4">Connexion</h2>
<form method="post" action="login_action.php" class="space-y-4">
    <input type="email" name="email" placeholder="Email" required class="border p-2 w-full">
    <input type="password" name="password" placeholder="Mot de passe" required class="border p-2 w-full">
    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Se connecter</button>
</form>
<p><a href="forgot_password.php" class="text-blue-600">Mot de passe oublié ?</a></p>
<?php include 'footer.php'; ?>