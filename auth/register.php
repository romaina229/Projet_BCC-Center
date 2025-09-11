<?php
require_once __DIR__ . "/../config.php"; 
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
<main class="max-w-7xl mx-auto  d-flex px-4 py-8">
<h2 class="text-xl font-bold mb-4">Inscription</h2>
<form method="post" action="register_action.php" class="space-y-4" onsubmit="return checkPasswords();">
    <input type="text" name="nom_prenom" placeholder="Nom et prénoms complet" required class="border p-2 w-average">
    <input type="text" name="username" placeholder="Nom d'utilisateur" required class="border p-2 w-average">
    <input type="email" name="email" placeholder="Email" required class="border p-2 w-average">    
    <!-- Mot de passe -->
    <input 
      type="password" 
      name="password" 
      id="password"
      placeholder="Mot de passe" 
      required 
      class="border p-2 w-average"
      pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^A-Za-z0-9]).{8,}" 
      title="Le mot de passe doit contenir au moins 8 caractères, dont une majuscule, une minuscule, un chiffre et un caractère spécial">    
    <!-- Confirmation mot de passe -->
    <input 
      type="password" 
      name="confirm_password" 
      id="confirm_password"
      placeholder="Confirmer le mot de passe" 
      required 
      class="border p-2 w-average">
    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">S'inscrire</button>
</form>

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