<?php

session_start();

if (isset($_SESSION['username'])) {
    header('Location: http://localhost/csp');
}


if (isset($_POST['signup_button'])) {
    include 'config.php';

    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, md5($_POST['password']));

    date_default_timezone_set('Asia/Kolkata');
    $registered_on = date('d/m/Y H:i:s', time());

    $sql = "SELECT username FROM users WHERE username = '{$username}'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        echo "Username already being used";
    } else {
        $sql1 = "SELECT email FROM users WHERE email = '{$email}'";
        $result1 = mysqli_query($conn, $sql1);

        if (mysqli_num_rows($result1) > 0) {
            echo "Email Already being Used";
        } else {
            $sql2 = "INSERT INTO `users`(`username`, `email`, `name`, `registered_date`, `password`) VALUES ('{$username}','{$email}','{$name}', NOW(),'{$password}')";

            if (mysqli_query($conn, $sql2)) {
                $_SESSION['username'] = $username;

                header("Location: http://localhost/csp/");
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - Code Sharing Platform</title>
    <link rel="stylesheet" href="./css/style.css">
</head>

<body id="signup-page">
    <div id="signup-header">
        <h2>Code Sharing Platform</h2>
    </div>
    <main>
        <div class="auth-form">
            <h1>Sign Up</h1>
            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" />
                <label for="email">Email</label>
                <input type="email" id="email" name="email" />
                <label for="username">Username</label>
                <input type="text" name="username" id="username" />
                <label for="password">Password</label>
                <input type="password" name="password" id="password" />
                <button type="submit" name="signup_button">Sign Up</button>
            </form>
            <p>Already have an account? <a href="login.php">Login</a></p>
        </div>
    </main>
    <script src="./js/app.js"></script>
</body>

</html>