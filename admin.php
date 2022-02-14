<?php 
    require('config/config.php');
    require('config/db.php');  
    include('config/functions.php');
    
    // error and input values
    $username = $password = '';
    $usernameErr = $passwordErr = $credentialErr = '';

    if(isset($_POST['submit'])) {
        // check if both inputs were submitted
        if (empty($_POST['username'])) {
            $usernameErr = 'Please fill in the username field.';
        } else {
            $username = mysqli_real_escape_string($conn, $_POST['username']);
        }

        if (empty($_POST['password'])) {
            $passwordErr = 'Please fill in the password field.';
        } else {
            $password = mysqli_real_escape_string($conn, $_POST['password']);
        }

        // if no errors, submit
        if (!empty($username) && !empty($password)) {
            $query = "SELECT * FROM admin WHERE username='$username' AND password='$password' LIMIT 1";
            $result = mysqli_query($conn, $query);

            if(mysqli_num_rows($result) == 1) {
                // correct credentials entered
                $_SESSION['isLoggedIn'] = 'Logged in!';
                header('Location: ' .ROOT_URL);
            } else {
                // incorrect username/password
                $credentialErr = 'The username or password is incorrect.';
            }
        }
    }
?>

<?php include('inc/header.php'); ?>
    <div class="container mt-3">
        <h1 class="text-center">Admin Login</h1>
        <form class="w-50 mx-auto mt-5" action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" >
            <div class="form-group">
                <label for="username">Username:</label>
                <input class="form-control" type="text" name="username" value="<?php echo $username; ?>">
                <p class="text-danger"><?php echo $usernameErr; ?></p>
            </div>
            <div class="form-group mt-3">
                <label for="password">Password:</label>
                <input class="form-control" type="password" name="password" value="<?php echo $password; ?>">
                <p class="text-danger"><?php echo $passwordErr; ?></p>
            </div>
            <input type="submit" name="submit" value="Login" class="btn btn-primary mx-auto mt-4">
            <p class="text-danger"><?php echo $credentialErr; ?></p>
        </form>
    </div>
<?php include('inc/footer.php'); ?>