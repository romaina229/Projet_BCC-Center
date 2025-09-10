 <!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BCC-Center</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <!-- HEADER avec logo rond et titre -->
    <header>
        <div class="header-container">
            <img src="../assets/images/logo bcc.png" alt="Logo BCC-Center" class="logo">
            <h1>BOOSTAGE DES COMPETENCES ET CAPACITES</h1>
        </div>
        
    </header>
 <body2 class="bg-gray-50 text-gray-900">
<script src="https://cdn.tailwindcss.com"></script>
<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
<header2 class="sticky top-0 z-40 bg-white/80 backdrop-blur border-b">
  <div class="max-w-7xl mx-auto px-4 py-3 flex items-center justify-between">
    <a href="/index.php" class="flex items-center gap-2 font-semibold">
    </a>
    <nav x-data="{open:false}" class="relative">
      <button class="md:hidden p-2 border rounded-xl" @click="open=!open" aria-label="Menu">
        ☰
      </button>
      <ul class="hidden md:flex gap-6 items-center">
        <li><a class="hover:text-indigo-600" href="/index.php">Accueil</a></li>
        <li><a class="hover:text-indigo-600" href="/formations.php">Formations</a></li>
        <li><a class="hover:text-indigo-600" href="/forum/index.php">Forum</a></li>
        <li><a class="hover:text-indigo-600" href="/auth/login.php">Connexion</a></li>
        <li><a class="hover:text-indigo-600" href="/auth/register.php">Créer un compte</a></li>
      </ul>
      <ul x-show="open" @click.away="open=false" class="md:hidden absolute right-0 mt-2 bg-white shadow rounded-xl p-3 space-y-2 w-56">
        <li><a class="block px-2 py-1 rounded hover:bg-gray-100" href="/index.php">Accueil</a></li>
        <li><a class="block px-2 py-1 rounded hover:bg-gray-100" href="/formations.php">Formations</a></li>
        <li><a class="block px-2 py-1 rounded hover:bg-gray-100" href="/forum/index.php">Forum</a></li>
        <li><a class="block px-2 py-1 rounded hover:bg-gray-100" href="/auth/login.php">Connexion</a></li>
        <li><a class="block px-2 py-1 rounded hover:bg-gray-100" href="/auth/register.php">Créer un compte</a></li>
      </ul>
    </nav>
  </div>
</header2>
</body2>

    <!-- SECTION INTRODUCTION -->
    <section class="intro"><p class="slogan">Une structure de renforcement des capacités et compétences des acteurs de projets/programmes innovants</p>
        <div class="intro-text">
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed vitae purus nec nulla aliquet commodo.</p>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec quis sapien in arcu suscipit tincidunt.</p>
        </div>
    </section>
  <section class="body2">
  <div class="programme">
    📚 Programme de Formation - BCC Center
  </div class= "programme">
    
    <div class="container">
    <h2>Formations en cours</h2>
    <table>
      <thead>
        <tr>
          <th>Module</th>
          <th>Thème</th>
          <th>Durée</th>
          <th>Formateur</th>
          <th>Statut</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>1</td>
          <td>Formation pratique sur l'utilisation professionnelle du logiciel MS Project</td>
          <td>2 jours</td>
          <td>M. Jons T. AGBOKO</td>
          <td><a href="/auth/login.php"><span class="status ongoing">En cours</span></a></td>
        </tr>
		<tr>
          <td>2</td>
          <td>Gestion de projet orientée résultats (GAR)</td>
          <td>3 jours</td>
          <td>Equipe BCC-Center</td>
          <td><span class="status upcoming">À venir</span></td>
        </tr>		
        <tr>
          <td>3</td>
          <td>Rédaction de plans d'affaires</td>
          <td>3 jours</td>
          <td>Equipe BCC-Center</td>
          <td><span class="status upcoming">À venir</span></td>
        </tr>
        <tr>
          <td>4</td>
          <td>Gestion de projets sensibles au genre et à l’inclusion sociale</td>
          <td>2 jours</td>
          <td>Expert invité</td>
          <td><span class="status upcoming">À venir</span></td>
        </tr>
        <tr>
          <td>5</td>
          <td>Gestion financière et mobilisation des ressources</td>
          <td>1 jour</td>
          <td>Equipe BCC-Center</td>
          <td><span class="status upcoming">À venir</span></td>
        </tr>
		<tr>
          <td>6</td>
          <td>Leadership et innovation en gestion de programme</td>
          <td>3 jours</td>
          <td>Equipe BCC-Center</td>
          <td><span class="status upcoming">À venir</span></td>
        </tr>
        <tr>
          <td>7</td>
          <td>Gestion de projets sensibles au genre et à l’inclusion sociale</td>
          <td>2 jours</td>
          <td>Expert invité</td>
          <td><span class="status upcoming">À venir</span></td>
        </tr>
        <tr>
          <td>8</td>
          <td>Suivi-évaluation et impact social</td>
          <td>1 jour</td>
          <td>Equipe BCC-Center</td>
          <td><span class="status upcoming">À venir</span></td>
        </tr>
		<tr>
          <td>9</td>
          <td>Conception et Gestion des projets : Vague 1 et 2</td>
          <td>1 jour</td>
          <td>Equipe BCC-Center</td>
          <td><span class="status completed">Terminé</span></td>
        </tr>
		<tr>
          <td>10</td>
          <td>Maîtrise des outils numériques de collecte de données</td>
          <td>1 jour</td>
          <td>Equipe BCC-Center</td>
          <td><span class="status completed">Terminé</span></td>
        </tr>
      </tbody>
    </table>
  </div>
 </section>

  <div class="programme">
    Quelques images de nos sessions de formation.
  </div class= "programme">
    <!-- SECTION PHOTOS -->
    <section class="photos">
        <div class="photo-box"><img src="../assets/images/image1.png" alt="Logo BCC-Center" class="logo"></div>
        <div class="photo-box"><img src="../assets/images/témoignage.png" alt="Logo BCC-Center" class="logo"></div>
        <div class="photo-box"><img src="../assets/images/image2.png" alt="Logo BCC-Center" class="logo"></div>
    </section>

    <!-- FOOTER -->
    <footer>
        <p>&copy; 2025 BCC-Center - Tous droits réservés</p>
    </footer>

</body>
</html>