<?php
require_once "../config.php"; 
require_login();

$id = intval($_GET['id'] ?? 0);
$stmt = $pdo->prepare("SELECT * FROM quizzes WHERE id=?");
$stmt->execute([$id]);
$quiz = $stmt->fetch();

if (!$quiz) die("QCM introuvable");

$questions = json_decode($quiz['questions_json'], true);
$answers = $_POST['answers'] ?? [];

$score = 0;
foreach ($questions as $i => $q) {
    if (isset($answers[$i]) && $answers[$i] == $q['answer']) {
        $score++;
    }
}

// Sauvegarde en base si table results existe
if ($pdo->query("SHOW TABLES LIKE 'results'")->rowCount()) {
    $stmt = $pdo->prepare("INSERT INTO results (quiz_id, user_id, score, total) VALUES (?,?,?,?)");
    $stmt->execute([$quiz['id'], current_user()['id'], $score, count($questions)]);
}

header("Location: result.php?id={$quiz['id']}&score={$score}&total=".count($questions));
exit;
