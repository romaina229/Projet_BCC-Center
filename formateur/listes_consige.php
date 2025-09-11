<?php
$dir = __DIR__ . "/../storage/consignes/";   // chemin réel
$urlPath = "../storage/consignes/";         // chemin public

echo "<h2>📚 Liste des consignes</h2>";
echo "<ul>";

if (is_dir($dir)) {
    $files = scandir($dir);
    foreach ($files as $file) {
        if ($file !== "." && $file !== "..") {
            echo "<li><a href='" . $urlPath . urlencode($file) . "' target='_blank' class='text-indigo-600'>" . htmlspecialchars($file) . "</a></li>";
        }
    }
} else {
    echo "<p>Le dossier des consignes est introuvable.</p>";
}
echo "</ul>";
?>
