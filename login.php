<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>User Login</title>
</head>

<body>
    <?php
    require('database.php');
    if (isset($_POST['username'])) {
        $username = stripslashes($_REQUEST['username']);
        $username = mysqli_real_escape_string($con, $username);
        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($con, $password);
        $query = "SELECT *
 FROM `users`
 WHERE username='$username'
 AND password='" . md5($password) . "'";
        $result = mysqli_query($con, $query) or die(mysqli_error($con));
        $rows = mysqli_num_rows($result);
        if ($rows == 1) {
            $userData = mysqli_fetch_assoc($result);
            $_SESSION['username'] = $userData['username'];
            $_SESSION['user_id'] = $userData['id'];

            if (isset($_POST['remember_me'])) {
                $cookie_name = "user";
                $cookie_value = $username;
                $expiration_time = time() + 60 * 60 * 24 * 30;
                setcookie($cookie_name, $cookie_value, $expiration_time, "/");
            }
            header("Location: index.php");
            exit();
        } else {
            echo "<div class='form'> 
         <h3>Username/password is incorrect.</h3> 
         <br/>Click here to <a href='login.php'>Login</a></div>";
        }
    } else {
    ?>
        <div class="form">
            <h1>User Log In</h1>
            <form action="" method="post" name="login">
                <input type="text" name="username" placeholder="Username" required /><br>
                <input type="password" name="password" placeholder="Password" required /><br>
                <p>
                    <label>Remember Me</label>
                    <input type="checkbox" name="remember_me" id="remember_me">
                </p>
                <input name="submit" type="submit" value="Login" />
            </form>
            <p>Not registered yet? <a href='registration.php'>Register Here</a></p>
        </div>
    <?php } ?>
</body>

</html>