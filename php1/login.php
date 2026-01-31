<?php
session_start();
require __DIR__ . '/connect.php';

$email = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';

if (!filter_var($email, FILTER_VALIDATE_EMAIL) || $password === '') {
  header('Location: index.php?login_error=Invalid%20credentials');
  exit;
}

try {
  $stmt = $pdo->prepare('SELECT id, name, password_hash FROM users WHERE email = ? LIMIT 1');
  $stmt->execute([$email]);
  $user = $stmt->fetch();

  if (!$user || !password_verify($password, $user['password_hash'])) {
    header('Location: index.php?login_error=Incorrect%20email%20or%20password');
    exit;
  }

  $_SESSION['user_id'] = $user['id'];
  $_SESSION['user_name'] = $user['name'];
  header('Location: homepage.php');
} catch (Throwable $e) {
  header('Location: index.php?login_error=Server%20error');
}