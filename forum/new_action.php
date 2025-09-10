<?php
require_once "../config.php"; require_login();
$title = trim($_POST['title'] ?? '');
$body  = trim($_POST['body'] ?? '');
if (!$title || !$body) { die("Champs manquants"); }
$stmt = $pdo->prepare("INSERT INTO forum_threads (user_id, title, body) VALUES (?,?,?)");
$stmt->execute([current_user()['id'], $title, $body]);
header("Location: /forum/index.php");
