<?php
session_start();
require __DIR__ . '/connect.php';

$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';
$telephone = $_post['Telephone'] ?? '';

if ($name === '' || !filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($password) < 6 || $telephone === '') {
  header('Location: index.php?register_error=Invalid%20inputs');
  exit;
}

try {
  // Check if email exists
  $stmt = $pdo->prepare('SELECT id FROM users WHERE email = ? LIMIT 1');
  $stmt->execute([$email]);
  if ($stmt->fetch()) {
    header('Location: index.php?register_error=Email%20already%20registered');
    exit;
  }

  // Hash and insert
  $hash = password_hash($password, PASSWORD_DEFAULT);
  $stmt = $pdo->prepare('INSERT INTO users (name, email, password_hash, telephone) VALUES (?, ?, ?, ?)');
  $stmt->execute([$name, $email, $hash,$telephone]);

  // Auto-login
  $_SESSION['user_id'] = $pdo->lastInsertId();
  $_SESSION['user_name'] = $name;
  header('Location: homepage.php');
} catch (Throwable $e) {
  header('Location: index.php?register_error=Server%20error');
}