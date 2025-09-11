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
        <li><a class="hover:text-indigo-600" href="../index.php">Accueil</a></li>
        <li><a class="hover:text-indigo-600" href="../formations.php">Formations</a></li>
        <li><a class="hover:text-indigo-600" href="../forum/index.php">Forum</a></li>
        <li><a class="hover:text-indigo-600" href="../auth/login.php">Connexion</a></li>
        <li><a class="hover:text-indigo-600" href="../auth/register.php">Créer un compte</a></li>
      </ul>
      <ul x-show="open" @click.away="open=false" class="md:hidden absolute right-0 mt-2 bg-white shadow rounded-xl p-3 space-y-2 w-56">
        <li><a class="block px-2 py-1 rounded hover:bg-gray-100" href="../index.php">Accueil</a></li>
        <li><a class="block px-2 py-1 rounded hover:bg-gray-100" href="../formations.php">Formations</a></li>
        <li><a class="block px-2 py-1 rounded hover:bg-gray-100" href="../forum/index.php">Forum</a></li>
        <li><a class="block px-2 py-1 rounded hover:bg-gray-100" href="../auth/login.php">Connexion</a></li>
        <li><a class="block px-2 py-1 rounded hover:bg-gray-100" href="../auth/register.php">Créer un compte</a></li>
      </ul>
    </nav>
  </div>
</header2>
</body2>

    <!-- SECTION INTRODUCTION -->
    <section class="intro">
      <p class="slogan1">Bienvenue sur notre plateforme !</p>
      <p class="slogan">Boostez vos compétences et transformez vos projets innovants en succès.</p>
        <div class="intro-text">
            <p>Dans le cadre de notre mission, nous nous engageons à renforcer les capacités et à développer les compétences des acteurs œuvrant dans la planification, la mise en œuvre et l’évaluation des projets et programmes. Notre approche met un accent particulier sur la sensibilité au genre, la promotion de l’inclusion sociale et la sauvegarde environnementale, afin de favoriser des initiatives durables et équitables.</p>
            <p>Pour bénéficier de nos sessions de formation, d’échanges d’expériences et d’outils pédagogiques, nous vous invitons à créer un compte sur notre plateforme dédiée. Ce pendant vous pouvez explorer nos ressources et vous impliquer dans nos activités.</p>
        </div>
    </section>
  <section class="body2">
  <div class="programme">
    📚 Programme de Formation - BCC Center
  </div class= "programme">
    
    <div class="container">
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
    <br>
    <p>
      Pour plus d'informations ou pour vous inscrire à une formation, veuillez <a href="../contact.php" class="text-indigo-600 hover:underline">nous contacter</a>.<br><br>
      Note : Les formations marquées "En cours" nécessitent une connexion. Veuillez <a href="../auth/login.php" class="text-indigo-600 hover:underline">vous connecter</a> pour accéder aux détails.
    </p>
  </div>
  </div>
 </section>

  <div class="programme">
    Quelques images de nos sessions de formation.
  </div class= "programme">
    <!-- SECTION PHOTOS -->
    <section class="photo-container">
        <div class="photo-track">
        <img src="../assets/images/participant.jpg" alt="Logo BCC-Center" class="logo">
        <img src="../assets/images/temoignage.jpg" alt="Logo BCC-Center" class="logo">
        <img src="../assets/images/image1.png" alt="Logo BCC-Center" class="logo">
        <img src="../assets/images/image2.png" alt="Logo BCC-Center" class="logo">
        <img src="../assets/images/vague1.jpg" alt="Logo BCC-Center" class="logo">
        <img src="../assets/images/image4.jpg" alt="Logo BCC-Center" class="logo">
        <img src="../assets/images/image5.jpg" alt="Logo BCC-Center" class="logo">
        <img src="../assets/images/image6.jpg" alt="Logo BCC-Center" class="logo">
        <img src="../assets/images/image7.jpg" alt="Logo BCC-Center" class="logo">
      <!-- Duplique les images pour un défilement continu -->
        <img src="../assets/images/participant.jpg" alt="Logo BCC-Center" class="logo">
        <img src="../assets/images/temoignage.jpg" alt="Logo BCC-Center" class="logo">
        <img src="../assets/images/image1.png" alt="Logo BCC-Center" class="logo">
        <img src="../assets/images/image2.png" alt="Logo BCC-Center" class="logo">
        <img src="../assets/images/vague1.jpg" alt="Logo BCC-Center" class="logo">
        <img src="../assets/images/image4.jpg" alt="Logo BCC-Center" class="logo">
        <img src="../assets/images/image5.jpg" alt="Logo BCC-Center" class="logo">
        <img src="../assets/images/image6.jpg" alt="Logo BCC-Center" class="logo">
        <img src="../assets/images/image7.jpg" alt="Logo BCC-Center" class="logo">
      </div>
    </section>

    <!-- FOOTER -->
    <footer>
        <div class="right"><p>&copy; 2025 BCC-Center - Tous droits réservés</p>
        <p id="lefth">Contact: <a href="mailto:boostagecenter@gmail.com" class="text-indigo-400 hover:underline">courrier électronique</a> | Téléphone: +229 01 40 15 24 43</p>
        <p id="lefth">Adresse: Abomey-Calavi, Cotonou, Bénin</p>
        <p id="center">Suivez-nous sur : 
            <a href="#" class="text-indigo-400 hover:underline">Facebook</a>, 
            <a href="#" class="text-indigo-400 hover:underline">Twitter</a>, 
            <a href="#" class="text-indigo-400 hover:underline">LinkedIn</a>
        </p>
        <p class="left"><a href="/about.php" class="text-indigo-400 hover:underline">À propos</a>,
        <a href="/contact.php" class="text-indigo-400 hover:underline">Contact</a>,
        <a href="/legal.php" class="text-indigo-400 hover:underline">Mentions légales</a></p>
        </div>
    </footer>

</body>
</html>