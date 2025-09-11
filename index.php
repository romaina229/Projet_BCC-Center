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
      <span class="inline-block w-20 h-20 b-2-s"><img src="./assets/images/logo bcc.png" alt="Logo BCC-Center" class="logo"></span>
      <span>BCC-Center</span>
    </a>
    <nav x-data="{open:false}" class="relative">
      <button class="md:hidden p-2 border rounded-xl" @click="open=!open" aria-label="Menu">
        ☰
      </button>
      <ul class="hidden md:flex gap-6 items-center">
        <li><a class="hover:text-indigo-600" href="/index.php">Accueil</a></li>
        <li><a class="hover:text-indigo-600" href="/formations.php">Formations</a></li>
        <li><a class="hover:text-indigo-600" href="./formation_passer/index.php">Espace programme</a></li>
        <li><a class="hover:text-indigo-600" href="./forum/index.php">Forum</a></li>
        <li><a class="hover:text-indigo-600" href="./auth/login.php">Connexion</a></li>
        <li><a class="hover:text-indigo-600" href="./auth/register.php">Créer un compte</a></li>
      </ul>
      <ul x-show="open" @click.away="open=false" class="md:hidden absolute right-0 mt-2 bg-white shadow rounded-xl p-3 space-y-2 w-56">
        <li><a class="block px-2 py-1 rounded hover:bg-gray-100" href="/index.php">Accueil</a></li>
        <li><a class="block px-2 py-1 rounded hover:bg-gray-100" href="/formations.php">Formations</a></li>
        <li><a class="block px-2 py-1 rounded hover:bg-gray-100" href="./formation_passer/index.php">Espace programme</a></li>
        <li><a class="block px-2 py-1 rounded hover:bg-gray-100" href="./forum/index.php">Forum</a></li>
        <li><a class="block px-2 py-1 rounded hover:bg-gray-100" href="./auth/login.php">Connexion</a></li>
        <li><a class="block px-2 py-1 rounded hover:bg-gray-100" href="./auth/register.php">Créer un compte</a></li>
      </ul>
    </nav>
  </div>
</header>
<main class="max-w-7xl mx-auto px-4 py-8">

<section class="grid md:grid-cols-2 gap-8 items-center">
  <div class="space-y-6">
    <h1 class="text-4xl md:text-5xl font-extrabold leading-tight">Bienvenue ! <br> Renforcez vos capacités et faites briller vos initiatives innovantes.<span class="text-indigo-600"> <br>BCC-Center</span></h1>
    <p class="text-lg text-gray-700">Nous œuvrons pour le renforcement des capacités et le développement des compétences des acteurs engagés dans la planification, la mise en œuvre et le suivi des projets et programmes sensibles au genre, favorisant l’inclusion sociale et garantissant la sauvegarde environnementale.
	<br> Afin de participer à nos sessions de formation et bénéficier de nos ressources pédagogiques, nous vous invitons à créer un compte sur notre plateforme dédiée.</p>
    <div class="flex gap-3">
      <a href="./auth/register.php" class="px-5 py-3 rounded-2xl bg-indigo-600 text-white hover:bg-indigo-700">Créer un compte</a>
      <a href="./auth/login.php" class="px-5 py-3 rounded-2xl border hover:bg-gray-100">Se connecter</a>
    </div>
  </div>
  <div class="bg-white border rounded-2xl p-6 shadow">
    <h2 class="text-xl font-semibold mb-3">Formations récentes</h2>
    <div class="grid gap-4" id="formations-list">
      <div class="p-4 rounded-xl border">
        <div class="font-semibold">Conception et Gestion des projets : Vague 1 et 2</div>
        <div class="text-sm text-gray-600">Exercice pratique en conption efficace des projets innovants sensibles au genre, inclusion sociale et sauvegarde environnementale.</div>
      </div>
      <div class="p-4 rounded-xl border">
        <div class="font-semibold">Maîtrise des outils numériques de collecte de données</div>
		<div class="font-semibold">Objectif :</div>
        <div class="text-sm text-gray-600">Permettre aux participants de concevoir, gérer et analyser efficacement des enquêtes et projets de collecte de données à l’aide d’outils numériques modernes, fiables et sécurisés.</div>
		<div class="font-semibold">Découverte des principaux outils</div>
		<div class="text-sm text-gray-600"><ul> <li>1. KoboToolbox : création de formulaires, déploiement sur mobile, collecte hors ligne</li>
		<li>2. Google Forms et Google Sheets : intégration rapide et gestion collaborative</li>
		<li>3. ODK (Open Data Kit) : conception de formulaires avancés, suivi et export des données</li> 
		<li>4. SurveyMonkey / Microsoft Forms : sondages en ligne et analyses basiques</li>
		</ul>
		</div>
      </div>
    </div>
  </div>
</section>
<section class="mt-12 grid md:grid-cols-3 gap-6">
  <div class="p-6 bg-white rounded-2xl border shadow">
  <img src="./assets/images/image6.jpg" alt="Logo BCC-Center" class="logo"><br>
    <h3 class="font-semibold text-lg">Espace participant</h3>
    <p class="text-gray-700">Déposer des exercices, passer les QCM, consulter les notes et badges.</p>
  </div>
  <div class="p-6 bg-white rounded-2xl border shadow">
  <img src="./assets/images/formateur.jpg" alt="Logo BCC-Center" class="logo"><br>
    <h3 class="font-semibold text-lg">Espace formateur</h3>
    <p class="text-gray-700">Créer des consignes, évaluer, attribuer notes et badges.</p>
  </div>
  <div class="p-6 bg-white rounded-2xl border shadow">
  <img src="./assets/images/participant.jpg" alt="Logo BCC-Center" class="logo"><br>
    <h3 class="font-semibold text-lg">Administration</h3>
    <p class="text-gray-700">Gestion des utilisateurs, formations, suivi global.</p>
  </div>
</section>
</main>
<footer class="border-t mt-12">
  <div class="max-w-7xl mx-auto px-4 py-6 text-sm text-gray-600 flex flex-wrap gap-4 justify-between">
    <span>Adresse : Abomey-Calavi, Bénin<br>Téléphone : +229 01 40 15 24 43<br>Contact : <a href="mailto:boostagecenter@gmail.com" class="hover:text-indigo-600"> courrier électronique</a><br>© 2025 BCC-Center - Tous droits réservés</span>
    <div class="space-x-4">
      <a href="/about.php" class="hover:text-indigo-600">À propos</a>
      <a href="/contact.php" class="hover:text-indigo-600">Contact</a>
      <a href="/legal.php" class="hover:text-indigo-600">Mentions légales</a>
    </div>
  </div>
</footer>
</body>
</html>