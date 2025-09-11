<?php
require_once __DIR__ . "/../config.php"; require_login();
if(!in_array(current_user()['role'], ['formateur','admin'])){die('Accès refusé');}
$ex_id = intval($_POST['exercice_id'] ?? 0); 
$score = intval($_POST['score'] ?? -1);
if(!$ex_id || $score<0 || $score>100){ die('Données invalides'); }
$stmt = $pdo->prepare("SELECT user_id FROM exercices WHERE id=?"); /*si avec le libelé exercice ne fonctionne pas revoir avec "exercice" selon ce qui est écrit dans la base de données: niveau ligne 3, 10, 11 pour changer exercice en formation et vérifier si le nom du table est exercices */
$stmt->execute([$ex_id]);
$row = $stmt->fetch();
if(!$row){ die('Exercice introuvable'); }
$stmt = $pdo->prepare("INSERT INTO notes (user_id, exercice_id, score) VALUES (?,?,?)");
$stmt->execute([$row['user_id'], $ex_id, $score]);
// Badge simple
if($score>=80){
  $stmt = $pdo->prepare("INSERT INTO badges (user_id, label) VALUES (?,?)");
  $stmt->execute([$row['user_id'], 'Excellence']);
}
header("Location: /formateur/evaluations.php");
