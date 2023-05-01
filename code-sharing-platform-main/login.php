<?php

session_start();

if (isset($_SESSION['username'])) {
    header("Location: http://localhost/csp", true);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log in - Code Sharing Platform</title>
    <link rel="stylesheet" href="./css/style.css">
</head>

<body id="signup-page">
    <div id="signup-header">
        <h2>Code Sharing Platform</h2>
    </div>

    <?php

    if (isset($_POST['login_button'])) {
        include "config.php";

        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = mysqli_real_escape_string($conn, md5($_POST['password']));

        $sql1 = "SELECT username FROM `admins` WHERE username = '{$username}' AND admin_password='${password}'";
        $result1 = mysqli_query($conn, $sql1);

        if (mysqli_num_rows($result1) > 0) {
            $_SESSION['username'] = $username;
            $_SESSION['user_role'] = 'admin';
            header("Location: http://localhost/csp");
        }

        $sql = "SELECT username FROM users WHERE username = '{$username}' AND password='${password}'";
        $result = mysqli_query($conn, $sql) or die('Query Failed.');

        if (mysqli_num_rows($result) > 0) {
            $_SESSION['username'] = $username;
            $_SESSION['user_role'] = 'user';
            header("Location: http://localhost/csp");
        } else {
            echo "Username or password did not matched.";
        }
    }

    ?>

    <main>
        <div class="auth-form">
            <h1>Log In</h1>
            <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" />
                <label for="password">Password</label>
                <input type="password" name="password" id="password" />
                <button type="submit" name="login_button">Log In</button>
            </form>
            <p>Or create <a href="./signup.php">A new account</a></p>
        </div>
    </main>
    <script src="./js/app.js"></script>
</body>

</html>