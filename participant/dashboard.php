<?php
require __DIR__ . "/../config.php";
if ($_SESSION['role'] !== 'participant') die("Accès refusé vous n'êtes pas participant ou pas connecté avec un compte valide participant.");
echo "<h1>Espace Participant</h1>";
echo "<p>Accès aux formations, consignes, QCM, Badges et attestations.</p>";
?>