<?php
require __DIR__ . '/../config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user) {
        $token = bin2hex(random_bytes(16));
        $stmt = $pdo->prepare("UPDATE users SET reset_token=? WHERE email=?");
        $stmt->execute([$token, $email]);

        $reset_link = "http://localhost/reset_password.php?token=" . $token;
        echo "Lien de réinitialisation : <a href='$reset_link'>$reset_link</a>";
    } else {
        echo "Email non trouvé.";
    }
}
?>