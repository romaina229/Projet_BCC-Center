<?php
session_start();
require __DIR__ . '/../config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    if (!$email) die("Veuillez entrer un email.");

    // Vérifier si l'email existe
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email=?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user) {
        // Générer token + expiration
        $token = bin2hex(random_bytes(16));
        $expires = date("Y-m-d H:i:s", strtotime("+1 hour"));

        $stmt = $pdo->prepare("UPDATE users SET reset_token=?, reset_expires=? WHERE email=?");
        $stmt->execute([$token, $expires, $email]);

        // Lien de réinitialisation
        $reset_link = "http://localhost/reset_password.php?token=$token";

        // Pour test → afficher le lien
        echo "Lien de réinitialisation (valide 1h) : <a href='$reset_link'>$reset_link</a>";

        // ⚡ En production → envoyer email
        /*
        mail($email, "Réinitialisation de votre mot de passe",
            "Cliquez sur ce lien pour réinitialiser votre mot de passe : $reset_link");
        */
    } else {
        echo "Email non trouvé.";
    }
}
?>
