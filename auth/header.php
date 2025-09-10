<?php
require_once __DIR__ . "/config.php"; 
?>
<header class="sticky top-0 z-40 bg-white/80 backdrop-blur border-b">
  <div class="max-w-7xl mx-auto px-4 py-3 flex items-center justify-between">
    <a href="/index.php" class="flex items-center gap-2 font-semibold">
      <span class="inline-block w-20 h-20 b-2-s"><img src="./assets/images/logo bcc.png" alt="Logo BCC-Center" class="logo"></span>
      <span>BCC-Center</span>
    </a>
    <nav>
      <ul class="flex gap-6 items-center">
        <li><a class="hover:text-indigo-600" href="/index.php">Accueil</a></li>
        <li><a class="hover:text-indigo-600" href="/formations.php">Formations</a></li>
        <li><a class="hover:text-indigo-600" href="/forum/index.php">Forum</a></li>

        <?php if (is_logged_in()): ?>
          <li><a class="hover:text-indigo-600" href="/qcm/index.php">QCM</a></li>
          <li><a class="hover:text-indigo-600" href="/auth/profile.php">Mon profil</a></li>
          <li><a class="hover:text-indigo-600" href="/auth/profile1.php">Mise à jour profil</a></li>

          <?php if (current_user()['role'] === 'admin'): ?>
            <li><a class="hover:text-indigo-600" href="/auth/user.php">Utilisateurs</a></li>
          <?php endif; ?>

          <li><a class="hover:text-red-600" href="logout.php">Déconnexion</a></li>
        <?php else: ?>
          <li><a class="hover:text-indigo-600" href="login.php">Connexion</a></li>
          <li><a class="hover:text-indigo-600" href="register.php">Créer un compte</a></li>
        <?php endif; ?>
      </ul>
    </nav>
  </div>
</header>
