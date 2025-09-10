<?php
require_once __DIR__ . "/config.php"; 
?>
<header class="sticky top-0 z-40 bg-white/80 backdrop-blur border-b">
  <div class="max-w-7xl mx-auto px-4 py-3 flex items-center justify-between">
    <a href="/index.php" class="flex items-center gap-2 font-semibold">
      <span class="inline-block w-8 h-8 rounded-2xl bg-indigo-600"></span>
      <span>BCC-Center</span>
    </a>
    <nav>
      <ul class="flex gap-6 items-center">
        <li><a class="hover:text-indigo-600" href="/index.php">Accueil</a></li>
        <li><a class="hover:text-indigo-600" href="/formations.php">Formations</a></li>
        <li><a class="hover:text-indigo-600" href="/forum/index.php">Forum</a></li>

        <?php if (is_logged_in()): ?>
          <li><a class="hover:text-indigo-600" href="/qcm/index.php">QCM</a></li>
          <li><a class="hover:text-indigo-600" href="/qcm/profile.php">Mon profil</a></li>

          <?php if (current_user()['role'] === 'admin'): ?>
            <li><a class="hover:text-indigo-600" href="/qcm/users.php">Utilisateurs</a></li>
          <?php endif; ?>

          <li><a class="hover:text-red-600" href="/auth/logout.php">Déconnexion</a></li>
        <?php else: ?>
          <li><a class="hover:text-indigo-600" href="/auth/login.php">Connexion</a></li>
          <li><a class="hover:text-indigo-600" href="/auth/register.php">Créer un compte</a></li>
        <?php endif; ?>
      </ul>
    </nav>
  </div>
</header>
