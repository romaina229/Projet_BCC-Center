<?php include 'header.php'; ?>
<h2 class="text-xl font-bold mb-4">Inscription</h2>
<form method="post" action="register_action.php" class="space-y-4" onsubmit="return checkPasswords();">
    <input type="text" name="nom_prenom" placeholder="Nom et prénoms complet" required class="border p-2 w-full">
    <input type="text" name="username" placeholder="Nom d'utilisateur" required class="border p-2 w-full">
    <input type="email" name="email" placeholder="Email" required class="border p-2 w-full">    
    <!-- Mot de passe -->
    <input 
      type="password" 
      name="password" 
      id="password"
      placeholder="Mot de passe" 
      required 
      class="border p-2 w-full"
      pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^A-Za-z0-9]).{8,}" 
      title="Le mot de passe doit contenir au moins 8 caractères, dont une majuscule, une minuscule, un chiffre et un caractère spécial">
    
    <!-- Confirmation mot de passe -->
    <input 
      type="password" 
      name="confirm_password" 
      id="confirm_password"
      placeholder="Confirmer le mot de passe" 
      required 
      class="border p-2 w-full">
    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">S'inscrire</button>
</form>

<?php include 'footer.php'; ?>

<script>
  function checkPasswords() {
    alert ("Inscription réussie !");
    return true; // autorise l’envoi du formulaire
  }
</script>

<script>
function checkPasswords() {
  const password = document.getElementById("password").value;
  const confirm = document.getElementById("confirm_password").value;

  if (password !== confirm) {
    alert("Les mots de passe ne correspondent pas !");
    return false; // bloque l’envoi du formulaire
  }
  return true;
}
</script>

<script>
function checkPasswords() {
  const password = document.getElementById("password").value;
  const confirm = document.getElementById("confirm_password").value;

  if (password !== confirm) {
    alert("Les mots de passe ne correspondent pas !");
    return false; // Empêche l’envoi du formulaire
  }
  return true; // Autorise l’envoi si tout est bon
}
</script>