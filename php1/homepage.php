<?php
session_start();
if (!isset($_SESSION['user_id'])) {
  header('Location: index.php');
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Homepage</title>
  <link rel="stylesheet" href="style.css" />
</head>
<body>
  <div class="auth-wrapper">
    <h2>Welcome, Int the Benjamin Website🔥🔥<?php echo htmlspecialchars($_SESSION['user_name']); ?> 🎉</h2>
    <p>You are logged in.</p>
    <form action="logout.php" method="POST">
      <button class="btn" type="submit">Logout</button>
    </form>
  </div>
</body>
</html>