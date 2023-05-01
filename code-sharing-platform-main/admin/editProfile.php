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
            <a href="../editor/create-new.php" class="btn" id="create-new-snippet-btn">Create New</a>
            <div class="user-details">
                <div class="user-avatar">
                    <?php

                    include "../config.php";

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
        </nav>
    </header>
    <div class="profile-navigation">
        <a href="./profile.php">Profile</a>
        <a href="./mySnippets.php">My Snippets</a>
        <a href="<?php echo $_SERVER["REQUEST_URI"] ?>">Edit Profile</a>
        <a href="./manageSnippets.php">Manage Snippets</a>
        <a href="./manageUsers.php">Manage Users</a>
        <a href="../logout.php">Log Out</a>
    </div>
    <div class="profile-details">
        <form method="post" action="updateProfile.php">
            <?php

            $sql = "SELECT * FROM `admins` WHERE `username`='{$_SESSION['username']}';";
            $result = mysqli_query($conn, $sql) or die("Query Failed.");

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {

                    ?>
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" id="name" name="name" value="<?php echo $row['name'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" id="username" name="username" value="<?php echo $row['username'] ?>">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" value="<?php echo $row['email'] ?>">
                    </div>
                    <?php

                }
            }
            ?>
            <button class="edit-profile-submit" name="edit-form-submit" id="edit-form-submit">Submit</button>
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
            <div class="user-avatar-actions">
                <button id="update-avatar-btn">
                    Update Image
                </button>
                <div id="user-avatar-upload" style="display: none;">
                    <form action="./uploadImage.php" method="post" enctype="multipart/form-data">
                        <input type="file" name="user_avatar" id="user_avatar" />
                        <button type="submit" name="submit_avatar" id="submit_avatar">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="../js/app.js"></script>
    <script>
        const updateAvatarBtn = document.getElementById("update-avatar-btn");
        const userAvatarUpload = document.getElementById("user-avatar-upload");

        updateAvatarBtn.addEventListener("click", () => {
            userAvatarUpload.style.display = userAvatarUpload.style.display == "none" ? "block" : "none";
        });
    </script>
</body>

</html>