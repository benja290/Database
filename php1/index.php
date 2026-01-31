<?php
session_start();
if (isset($_SESSION['user_id'])) {
  header('Location: homepage.php');
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Auth | Login & Register</title>
  <link rel="stylesheet" href="style.css" />
</head>
<body>
  <div class="auth-wrapper">
    <div class="tabs">
      <button id="loginTab" class="tab active">Login</button>
      <button id="registerTab" class="tab">Register</button>
    </div>

    <!-- Login form -->
    <form id="loginForm" class="form active" method="POST" action="login.php" novalidate>
      <div class="field">
        <label for="loginEmail">Email</label>
        <input type="email" id="loginEmail" name="email" required />
      </div>
      <div class="field">
        <label for="loginPassword">Password</label>
        <input type="password" id="loginPassword" name="password" required minlength="6" />
      </div>
      <button type="submit" class="btn">Login</button>
      <?php if (isset($_GET['login_error'])): ?>
        <p class="error"><?php echo htmlspecialchars($_GET['login_error']); ?></p>
      <?php endif; ?>
    </form>

    <!-- Register form -->
    <form id="registerForm" class="form" method="POST" action="register.php" novalidate>
      <div class="field">
        <label for="regName">Full name</label>
        <input type="text" id="regName" name="name" required />
      </div>
      <div class="field">
        <label for="regEmail">Email</label>
        <input type="email" id="regEmail" name="email" required />
      </div>
      <div class="field">
        <label for="regPassword">Password</label>
        <input type="password" id="regPassword" name="password" required minlength="6" />
      </div>
      <div class="field">
        <label for="">Telephone</label>
        <input type="phone" id="regTelephone" name="telephone" require minlength="6">
      </div>
      <button type="submit" class="btn">Create account</button>
      <?php if (isset($_GET['register_error'])): ?>
        <p class="error"><?php echo htmlspecialchars($_GET['register_error']); ?></p>
      <?php endif; ?>
    </form>
  </div>

  <script src="script.js"></script>
</body>
</html>