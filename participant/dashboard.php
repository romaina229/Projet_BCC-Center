<?php
require "../config.php";
if ($_SESSION['role'] !== 'participant') die("Accès refusé");
echo "<h1>Espace Participant</h1>";
echo "<p>Accès aux formations, consignes, QCM, Badges et attestations.</p>";
?>