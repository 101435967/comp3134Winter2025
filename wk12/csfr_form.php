<?php
   ob_start();
   session_start();

   // Generate a session token for confirmation (optional CSRF protection)
   if (empty($_SESSION['confirmation'])) {
       $_SESSION['confirmation'] = bin2hex(random_bytes(16));
   }

   $msg = '';

   if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
      $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
      $confirmation = $_POST['confirmation'];

      if (!empty($username) && !empty($password)) {
         if ($username === 'host' && $password === 'pass' && $confirmation === $_SESSION['confirmation']) {
            $_SESSION['valid'] = true;
            $_SESSION['timeout'] = time();
            $_SESSION['username'] = 'host';

            echo ' You have entered a valid username and password.';
         } else {
            $msg = ' Wrong username, password, or confirmation token.';
         }
      }
   }
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <title>Login Page</title>
   <style>
      body { font-family: Arial, sans-serif; padding: 20px; }
      .form-signin { max-width: 300px; margin: auto; }
      input, button { width: 100%; margin-bottom: 10px; padding: 10px; }
      .msg { color: red; }
   </style>
</head>
<body>

   <h2>Enter Username and Password</h2>

   <div class="container form-signin">
      <form class="form-signin" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
         <?php if (!empty($msg)) echo "<p class='msg'>$msg</p>"; ?>
         <input type="text" name="username" placeholder="Username: host" required autofocus>
         <input type="password" name="password" placeholder="Password: pass" required>
         <input type="hidden" name="confirmation" value="<?php echo $_SESSION['confirmation']; ?>">
         <button type="submit" name="submit">Submit</button>
      </form>

      <p>Click here to <a href="logout.php" title="Logout">logout and clear session</a>.</p>
   </div>

</body>
</html>
