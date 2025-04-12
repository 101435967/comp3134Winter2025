<?php
   ob_start();
   session_start();
?>

<!DOCTYPE html>
<html lang="en">  
<head>
    <meta charset="UTF-8">
    <title>Login Page</title>   
</head>
	
<body> 
    <h2>Enter Username and Password</h2> 
    <div class="container form-signin">
        <?php
            $msg = '';   
            if (isset($_POST['submit']) && !empty($_POST['username']) && !empty($_POST['password'])) {
                
                $username = $_POST['username'];
                $password = $_POST['password'];

                if ($username === 'host' && $password === 'pass') {
                    $_SESSION['valid'] = true;
                    $_SESSION['timeout'] = time();
                    $_SESSION['username'] = $username;

                    echo '<p style="color: green;">You have entered valid username and password.</p>';
                    // Redirect or continue to dashboard.php if needed
                    // header("Location: dashboard.php");
                } else {
                    $msg = 'Wrong username or password';
                }
            }
        ?>
    </div> <!-- /container -->
    
    <div class="container">
        <form class="form-signin" role="form" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
            <h4 class="form-signin-heading" style="color: red;"><?php echo $msg; ?></h4>
            <input type="text" class="form-control" name="username" placeholder="username = host" required autofocus><br>
            <input type="password" class="form-control" name="password" placeholder="password = pass" required><br>
            <button class="btn btn-lg btn-primary btn-block" type="submit" name="submit">Submit</button>
        </form>
        
        <p>Click here to clear session: <a href="logout.php" title="Logout">Logout</a></p>
    </div> 
</body>
</html>
