<?php
require_once 'vendor/autoload.php'; // Si tu utilises PHPWord
require_once '/attestation/certificates/index.php';

use PhpOffice\PhpWord\TemplateProcessor;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;

// Vérifie que le formulaire a été envoyé
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Récupère les données du formulaire
    $nom_prenom = isset($_POST['nom_prenom']) ? $_POST['nom_prenom'] : '';
    $date = isset($_POST['date']) ? $_POST['date'] : date('d/m/Y'); // par défaut aujourd'hui
    $titre_formation = isset($_POST['titre_formation']) ? $_POST['titre_formation'] : '';

    // Chemin vers ton modèle DOCX
    $template = new TemplateProcessor('modele_attestation.docx');

    // Remplace les variables dans le modèle par les valeurs dynamiques
    $template->setValue('nom_prenom', $nom_prenom);
    $template->setValue('date', $date);
    $template->setValue('titre_formation', $titre_formation);

    // Nom du fichier de sortie
    $fichier_sortie = 'attestation_'.$nom_prenom.'.docx';

    // Génère le fichier
    $template->saveAs($fichier_sortie);
	require 'vendor/autoload.php'; // Composer autoload

function generate_and_send_certificate($user_id){
    $user = get_user_info($user_id); // Récupérer nom, prénom, formation, date...

    $phpWord = new PhpWord();
    $template = $phpWord->loadTemplate('modele_attestation.docx'); // ton modèle

    // Remplacer les variables dans le modèle
    $template->setValue('nom', $user['nom']);
    $template->setValue('prenom', $user['prenom']);
    $template->setValue('formation', 'Nom de la formation');
    $template->setValue('date', date('d/m/Y'));

    // Enregistrer le fichier généré
    $filename = 'attestation_'.$user_id.'.docx';
    $filepath = __DIR__ . '/attestation/certificates/' . $filename;
    $template->saveAs($filepath);
	
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