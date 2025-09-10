<?php
require "../config.php";
if ($_SESSION['role'] !== 'formateur') die("Accès refusé");
echo "<h1>Espace Formateur</h1>";
echo "<ul>
<li><a href='ajouter_formation.php'>Créer une formation</a></li>
<li><a href='ajouter_consigne.php'>Ajouter une consigne</a></li>
<li><a href='ajouter_qcm.php'>Créer un QCM</a></li>
<li><a href='ajouter_question.php'>Ajouter des questions</a></li>
<li><a href='evaluer.php'>Evaluer</a></li>
</ul>";
?>