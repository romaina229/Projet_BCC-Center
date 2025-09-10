<?php
require_once __DIR__ . '/vendor/autoload.php'; // Si tu utilises PHPWord

use PhpOffice\PhpWord\IOFactory;
use Dompdf\Dompdf;

	// Vérifie que le formulaire a été envoyé
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Récupère les données du formulaire
    $nom_prenom = isset($_POST['nom_prenom']) ? $_POST['nom_prenom'] : '';
    $date = isset($_POST['date']) ? $_POST['date'] : date('d/m/Y'); // par défaut aujourd'hui
    $titre = isset($_POST['titre']) ? $_POST['titre'] : '';

    // Chemin vers ton modèle DOCX
    $template = new TemplateProcessor(__DIR__ . 'modele_attestation.docx');

    // Remplace les variables dans le modèle par les valeurs dynamiques
    $template->setValue('nom_prenom', $nom_prenom);
    $template->setValue('date', $date);
    $template->setValue('title', $title);

    // Nom du fichier de sortie
    $fichier_sortie = 'attestation_'.$nom_prenom.'.pdf';
	$chemin_sortie = __DIR__ . "/attestations/certificates/" . $fichier_sortie;
	
    // Génère le fichier
    $template->saveAs($fichier_sortie);
	
	// Supprimer le fichier temporaire
	unlink($tempHtmlFile);

    // Optionnel : forcer le téléchargement par le navigateur
    header('Content-Description: File Transfer');
    header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
    header('Content-Disposition: attachment; filename="'.basename($fichier_sortie).'"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($fichier_sortie));
    readfile($fichier_sortie);
    exit;
}
?>