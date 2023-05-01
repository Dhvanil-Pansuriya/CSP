<?php

session_start();

if (!isset($_SESSION['username'])) {
    header("Location: http://localhost/csp/login.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Code Sharing Platform</title>
    <link rel="stylesheet" href="../css/style.css">
</head>

<body id="profile">
    <header>

        <div class="logo">
            <span>Code sharing platform</span>
        </div>
        <nav>
            <a href="./editor/create-new.php" class="btn" id="create-new-snippet-btn">Create New</a>
            <div class="user-details">
                <div class="user-avatar">
                    <?php
                    include "../config.php";
                    $username = $_SESSION['username'];

                    if ($_SESSION['user_role'] == 'admin') {
                        $sql1 = "SELECT user_avatar FROM admins WHERE `username`='${username}'";
                        $result1 = mysqli_query($conn, $sql1) or die("Query Failed.");

                        if (mysqli_num_rows($result1) > 0) {
                            while ($row = mysqli_fetch_assoc($result1)) {
                                if ($row['user_avatar'] == null) {
                                    ?>
                                    <img src="../images/default_avatar.jpg" alt="Author avatar">
                                    <?php
                                } else {
                                    ?>
                                    <img src="../images/user_avatars/<?php echo $row['user_avatar'] ?>" alt="Author avatar">
                                    <?php
                                }
                            }
                        }
                    }
                    ?>
                </div>
                <?php if ($_SESSION['user_role'] == "admin") {
                    ?>
                    <div class="user-navigation">
                        <p>
                            <?php echo $_SESSION['username']; ?>
                        </p>
                        <a href="./admin/profile.php?username=<?php echo $_SESSION['username']; ?>">Profile</a>
                        <a href="/admin/manageUsers.php">
                            Manage Users
                        </a>
                        <a href="/admin/manageSnippets.php">
                            Manage Snippets
                        </a>
                        <a href="./logout.php">Log out</a>
                    </div>
                <?php } ?>
            </div>
        </nav>
    </header>
    <div class="profile-navigation">
        <a href="<?php echo $_SERVER["REQUEST_URI"] ?>">Profile</a>
        <a href="./mySnippets.php">My Snippets</a>
        <a href="./editProfile.php?username=<?php echo $_SESSION['username'] ?>">Edit Profile</a>
        <a href="./manageSnippets.php">Manage Snippets</a>
        <a href="./manageUsers.php">Manage Users</a>
        <a href="../logout.php">Log Out</a>
    </div>
    <div class="profile-details">
        <form>
            <?php

            $sql = "SELECT * FROM `admins` WHERE `username`='{$_SESSION['username']}';";
            $result = mysqli_query($conn, $sql) or die("Query Failed.");

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {

                    ?>
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input readonly type="text" id="name" name="name" value="<?php echo $row['name'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input readonly type="text" id="username" name="username" value="<?php echo $row['username'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input readonly type="email" id="email" name="email" value="<?php echo $row['email'] ?>">
                    </div>
                    <?php

                }
            }
            ?>
        </form>
        <div class="user-avatar-container">
            <div class="user-avatar">
                <?php
                $username = $_SESSION['username'];
                $sql1 = "SELECT user_avatar FROM users WHERE `username`='${username}'";
                $result1 = mysqli_query($conn, $sql1) or die("Query Failed.");

                if (mysqli_num_rows($result1) > 0) {
                    while ($row = mysqli_fetch_assoc($result1)) {
                        if ($row['user_avatar'] == null) {
                            ?>
                            <img src="../images/default_avatar.jpg" alt="Author avatar">
                            <?php
                        } else {
                            ?>
                            <img src="../images/user_avatars/<?php echo $row['user_avatar'] ?>" alt="Author avatar">
                            <?php
                        }
                    }
                }


                ?>
            </div>
        </div>
    </div>

    <script src="../js/app.js"></script>
</body>

</html>