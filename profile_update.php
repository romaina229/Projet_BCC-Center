<?php
require 'config.php';
if (!isset($_SESSION['user_id'])) { header("Location: login.php"); exit; }

$fullname = $_POST['fullname'];
$email = $_POST['email'];
$address = $_POST['address'];

$profile_picture = null;
if (!empty($_FILES['profile_picture']['name'])) {
    $profile_picture = time() . "_" . basename($_FILES['profile_picture']['name']);
    move_uploaded_file($_FILES['profile_picture']['tmp_name'], "uploads/" . $profile_picture);
}

if ($profile_picture) {
    $stmt = $pdo->prepare("UPDATE users SET fullname=?, email=?, address=?, profile_picture=? WHERE id=?");
    $stmt->execute([$fullname, $email, $address, $profile_picture, $_SESSION['user_id']]);
} else {
    $stmt = $pdo->prepare("UPDATE users SET fullname=?, email=?, address=? WHERE id=?");
    $stmt->execute([$fullname, $email, $address, $_SESSION['user_id']]);
}

header("Location: profile.php");
exit;
?>