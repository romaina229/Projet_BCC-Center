<?php
// Classe pour gérer la conversion conditionnelle Word vers PDF
class WordToPDFConverter {
    private $wordFile;
    private $pdfFile;
    private $conditions;
    private $tempDir = 'temp/';
    private $outputDir = 'output/';
    
    public function __construct($wordFile) {
        $this->wordFile = $wordFile;
        $this->conditions = [];
        
        // Créer les répertoires s'ils n'existent pas
        if (!file_exists($this->tempDir)) {
            mkdir($this->tempDir, 0777, true);
        }
        if (!file_exists($this->outputDir)) {
            mkdir($this->outputDir, 0777, true);
        }
    }
    
    /**
     * Ajouter une condition à vérifier avant la conversion
     */
    public function addCondition($conditionName, $callback) {
        $this->conditions[$conditionName] = $callback;
    }
    
    /**
     * Vérifier si toutes les conditions sont remplies
     */
    private function checkConditions() {
        foreach ($this->conditions as $name => $condition) {
            if (!call_user_func($condition)) {
                throw new Exception("Condition non satisfaite: $name");
            }
        }
        return true;
    }
    
    /**
     * Convertir le document Word en PDF si les conditions sont remplies
     */
    public function convertToPDF() {
        try {
            // Vérifier que le fichier Word existe
            if (!file_exists($this->wordFile)) {
                throw new Exception("Fichier Word introuvable: " . $this->wordFile);
            }
            
            // Vérifier toutes les conditions
            $this->checkConditions();
            
            // Générer un nom de fichier PDF basé sur le nom du fichier Word
            $baseName = pathinfo($this->wordFile, PATHINFO_FILENAME);
            $this->pdfFile = $this->outputDir . $baseName . '_' . date('Y-m-d_H-i-s') . '.pdf';
            
            // Conversion Word vers PDF
            if ($this->convertWithLibreOffice()) {
                return $this->pdfFile;
            } else {
                throw new Exception("Échec de la conversion PDF");
            }
            
        } catch (Exception $e) {
            // Journaliser l'erreur
            error_log("Erreur de conversion: " . $e->getMessage());
            return false;
        }
    }
    
    /**
     * Méthode de conversion utilisant LibreOffice
     * (Alternative: utiliser COM object sur Windows ou d'autres bibliothèques)
     */
    private function convertWithLibreOffice() {
        // Commande pour convertir Word en PDF avec LibreOffice
        $command = "libreoffice --headless --convert-to pdf --outdir " . 
                   escapeshellarg($this->outputDir) . " " . 
                   escapeshellarg($this->wordFile) . " 2>&1";
        
        // Exécuter la commande
        exec($command, $output, $returnCode);
        
        // Vérifier si la conversion a réussi
        if ($returnCode === 0) {
            // Trouver le fichier PDF généré
            $baseName = pathinfo($this->wordFile, PATHINFO_FILENAME);
            $generatedPdf = $this->outputDir . $baseName . '.pdf';
            
            // Renommer avec timestamp pour éviter les écrasements
            if (file_exists($generatedPdf)) {
                rename($generatedPdf, $this->pdfFile);
                return true;
            }
        }
        
        // Journaliser les erreurs de conversion
        error_log("LibreOffice conversion error: " . implode("\n", $output));
        return false;
    }
    
    /**
     * Méthode alternative pour Windows avec COM object
     * (Nécessite l'installation de Microsoft Office)
     */
    private function convertWithCOM() {
        // Vérifier si nous sommes sur Windows
        if (strtoupper(substr(PHP_OS, 0, 3)) !== 'WIN') {
            return false;
        }
        
        try {
            // Créer une instance COM de Word
            $word = new COM("Word.Application") or die("Impossible d'instancier Word");
            $word->Visible = false;
            $word->DisplayAlerts = false;
            
            // Ouvrir le document Word
            $document = $word->Documents->Open(realpath($this->wordFile));
            
            // Enregistrer en PDF
            $document->ExportAsFixedFormat(
                realpath($this->pdfFile), 
                17, // wdExportFormatPDF
                false, // openAfterExport
                0, // optimizeFor
                0 // range
            );
            
            // Fermer le document et quitter Word
            $document->Close(false);
            $word->Quit();
            
            // Libérer les objets COM
            $document = null;
            $word = null;
            
            return true;
            
        } catch (Exception $e) {
            error_log("COM conversion error: " . $e->getMessage());
            return false;
        }
    }
}

// Exemple d'utilisation
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Vérifier que le fichier a été uploadé
    if (isset($_FILES['wordFile']) && $_FILES['wordFile']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = 'uploads/';
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }
        
        $wordFile = $uploadDir . basename($_FILES['wordFile']['name']);
        move_uploaded_file($_FILES['wordFile']['tmp_name'], $wordFile);
        
        // Créer le convertisseur
        $converter = new WordToPDFConverter($wordFile);
        
        // Ajouter des conditions personnalisables
        $converter->addCondition('Fichier non vide', function() use ($wordFile) {
            return filesize($wordFile) > 0;
        });
        
        $converter->addCondition('Extension valide', function() use ($wordFile) {
            $ext = pathinfo($wordFile, PATHINFO_EXTENSION);
            return in_array(strtolower($ext), ['doc', 'docx', 'rtf']);
        });
        
        // Ajouter d'autres conditions selon vos besoins
        $converter->addCondition('Validation métier', function() {
            // Exemple: vérifier si l'utilisateur est autorisé
            return isset($_SESSION['user_id']); // À adapter selon votre système d'authentification
        });
        
        // Effectuer la conversion
        $pdfPath = $converter->convertToPDF();
        
        if ($pdfPath) {
            // Rediriger vers le PDF ou l'afficher
            header('Content-Type: application/pdf');
            header('Content-Disposition: inline; filename="' . basename($pdfPath) . '"');
            readfile($pdfPath);
            exit;
        } else {
            echo "Erreur lors de la conversion du document.";
        }
    } else {
        echo "Veuillez sélectionner un fichier Word valide.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conversion Word vers PDF</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f5f5f5;
        }
        .container {
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #2c3e50;
            text-align: center;
        }
        .upload-form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }
        input[type="file"] {
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        button {
            background-color: #3498db;
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover {
            background-color: #2980b9;
        }
        .note {
            margin-top: 20px;
            padding: 15px;
            background-color: #f8f9fa;
            border-left: 4px solid #3498db;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Conversion Word vers PDF</h1>
        
        <form class="upload-form" method="POST" enctype="multipart/form-data">
            <div>
                <label for="wordFile">Sélectionnez votre document Word:</label>
                <input type="file" id="wordFile" name="wordFile" accept=".doc,.docx,application/msword" required>
            </div>
            
            <button type="submit">Convertir en PDF</button>
        </form>
        
        <div class="note">
            <strong>Note:</strong> Cette conversion nécessite que LibreOffice soit installé sur le serveur.
            Le document ne sera converti que si toutes les conditions définies sont satisfaites.
        </div>
    </div>
</body>
</html>