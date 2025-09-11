<?php
require __DIR__ . '/../config.php';
if ($_SESSION['role'] !== 'formateur') die("Accès refusé");
echo "<h1>Espace Formateur</h1>";
echo "<ul>
<li><a href='../auth/temoins.php'>Créer une formation</a></li>
<li><a href='ajouter_consigne.php'>Ajouter une consigne</a></li>
<li><a href='ajouter_qcm.php'>Créer un QCM simple</a></li>
<li><a href='../qcm/builder.php'>Créer un QCM depuis un fichier JSON</a></li>
<li><a href='ajouter_question.php'>Ajouter des questions</a></li>
<li><a href='evaluations.php'>Evaluer un exercice</a></li>
</ul>";