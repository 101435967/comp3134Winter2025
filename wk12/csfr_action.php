<?php
   ob_start();
   session_start();
?>

<html lang="en">
<head>
   <meta charset="UTF-8">
   <title>Simple Login Page</title>
   <style>
      body {
         font-family: Arial, sans-serif;
         margin: 50px;
         background-color: #f4f4f4;
      }
      .container {
         max-width: 400px;
         margin: auto;
         background: white;
         padding: 20px;
         border-radius: 10px;
         box-shadow: 0px 0px 10px rgba(0,0,0,0.1);
      }
      input[type="text"], input[type="password"] {
         width: 100%;
         padding: 10px;
         margin: 10px 0;
         border: 1px solid #ccc;
         border-radius: 5px;
      }
      .btn {
         background-color: #007bff;
         color: white;
         padding: 10px;
         border: none;
         border-radius: 5px;
         cursor: pointer;
         width: 100%;
      }
      .success {
         color: green;
      }
      .error {
         color: red;
      }
   </style>
</head>

<body>

   <h2>Login Form</h2>

   <div class="container">
      <?php
         $msg = '';

         if (isset($_POST['submit']) && !empty($_POST['username']) 
            && !empty($_POST['password']) && ($_POST['confirmation'] == "confirmation")) {
            
            if ($_POST['username'] == 'host' && $_POST['password'] == 'pass') {
               $_SESSION['valid'] = true;
               $_SESSION['timeout'] = time();
               $_SESSION['username'] = 'host';
               $_SESSION['confirmation'] = 'confirmation';
               
               echo '<p class="success"> Login successful! Welcome, host.</p>';
            } else {
               $msg = '<p class="error"> Incorrect username or password</p>';
            }
         }
      ?>

      <form class="form-signin" role="form" 
         action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
         
         <?php echo $msg; ?>
         
         <input type="text" name="username" placeholder="Enter username" required autofocus>
         <input type="password" name="password" placeholder="Enter password" required>
         <input type="hidden" name="confirmation" value="confirmation">
         <button class="btn" type="submit" name="submit">Login</button>
      </form>

      <p>Click here to <a href="logout.php" title="Logout">logout and clear session</a>.</p>
   </div>

</body>
</html>
