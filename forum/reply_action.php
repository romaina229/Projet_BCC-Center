<?php
require_once __DIR__ . "/../config.php"; require_login();
$thread_id = intval($_POST['thread_id'] ?? 0);
$body = trim($_POST['body'] ?? '');
if (!$thread_id || !$body) { die("Champs manquants"); }
$stmt = $pdo->prepare("INSERT INTO forum_posts (thread_id, user_id, body) VALUES (?,?,?)");
$stmt->execute([$thread_id, current_user()['id'], $body]);
header("Location: /forum/thread.php?id=" . $thread_id);
