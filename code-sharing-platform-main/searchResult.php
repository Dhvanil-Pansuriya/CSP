<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results Page</title>
    <link rel="stylesheet" href="./css/style.css">
</head>

<body id="searchResult">
    <header>
        <div class="logo">
            <span>Code sharing platform</span>
        </div>
        <nav>
            <a href="./editor/create-new.php" class="btn" id="create-new-snippet-btn">Create New</a>
            <div class="user-details">
                <div class="user-avatar">
                    <?php
                    include "config.php";
                    $username = $_SESSION['username'];

                    if ($_SESSION['user_role'] == 'admin') {
                        $sql1 = "SELECT user_avatar FROM admins WHERE `username`='${username}'";
                        $result1 = mysqli_query($conn, $sql1) or die("Query Failed.");

                        if (mysqli_num_rows($result1) > 0) {
                            while ($row = mysqli_fetch_assoc($result1)) {
                                if ($row['user_avatar'] == null) {
                                    ?>
                                    <img src="./images/default_avatar.jpg" alt="Author avatar">
                                    <?php
                                } else {
                                    ?>
                                    <img src="./images/user_avatars/<?php echo $row['user_avatar'] ?>" alt="Author avatar">
                                    <?php
                                }
                            }
                        }
                    }
                    if ($_SESSION['user_role'] == 'user') {
                        $sql1 = "SELECT user_avatar FROM users WHERE `username`='${username}'";
                        $result1 = mysqli_query($conn, $sql1) or die("Query Failed.");

                        if (mysqli_num_rows($result1) > 0) {
                            while ($row = mysqli_fetch_assoc($result1)) {
                                if ($row['user_avatar'] == null) {
                                    ?>
                                    <img src="./images/default_avatar.jpg" alt="Author avatar">
                                    <?php
                                } else {
                                    ?>
                                    <img src="./images/user_avatars/<?php echo $row['user_avatar'] ?>" alt="Author avatar">
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
                        <a href="./admin/manageUsers.php">
                            Manage Users
                        </a>
                        <a href="./admin/manageSnippets.php">
                            Manage Snippets
                        </a>
                        <a href="./logout.php">Log out</a>
                    </div>
                <?php } ?>
                <?php if ($_SESSION['user_role'] == "user") {
                    ?>
                    <div class="user-navigation">
                        <p>
                            <?php echo $_SESSION['username']; ?>
                        </p>
                        <a href="./user/profile.php?username=<?php echo $_SESSION['username']; ?>">Profile</a>
                        <a href="./logout.php">Log out</a>
                    </div>
                <?php } ?>
            </div>
        </nav>
    </header>
    <section id="hero">
        <div class="hero-content">
            <h1>Result for:
                <?php echo $_GET['search-query'] ?>
            </h1>
            <form id="search-bar" action="./searchResult.php">
                <input type="search" name="search-query" id="search-input" />
                <button type="submit" id="submit-search" name="submit-search">Search</button>
            </form>
        </div>
    </section>
    <section class="snippets">
        <h2>Latest Uploads</h2>
        <div class="snippet-grid">
            <div class="container">
                <?php
                $searchTerm = $_GET['search-query'];

                $sql = "SELECT * FROM code_snippets INNER JOIN users ON code_snippets.author = users.username WHERE title LIKE '%${searchTerm}%';";
                $result = mysqli_query($conn, $sql) or die("Query Failed.");

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {

                        ?>
                        <div class="snippet-card">
                            <h4>
                                <?php echo $row['title']; ?>
                            </h4>
                            <div class="author-details">
                                <div class="author-avatar">
                                    <?php
                                    if ($row['user_avatar'] == null) {
                                        ?>
                                        <img src="./images/default_avatar.jpg" alt="Author avatar">
                                        <?php
                                    } else {
                                        ?>
                                        <img src="./images/user_avatars/<?php echo $row['user_avatar'] ?>" alt="Author avatar">
                                        <?php
                                    }
                                    ?>
                                </div>
                                <address>
                                    <p>
                                        <?php echo $row['name'] ?>
                                    </p>
                                    <p>
                                        <?php echo $row['username'] ?>
                                    </p>
                                </address>
                            </div>
                            <div class="snippet-actions">
                                <a class="btn view-code-btn"
                                    href="./editor/update.php?snippet_id=<?php echo $row['snippet_id'] ?>">
                                    view code</a>
                            </div>
                        </div>
                        <?php
                    }
                } else {
                    ?>
                    <div style="text-align: center">
                        <p style="color: rgba(255,255,255,0.5); font-size: 24px;margin: 60px auto;">No Results Found.</p>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
    </section>
    <footer>
        <div class="logo">
            <span>Code sharing platform</span>
        </div>
    </footer>


    <script src="./js/app.js"></script>
    <script>
        /* Header User Details navigation menu */
        const userNavigation = document.querySelector(
            "header .user-details .user-navigation"
        );
        const userAvatar = document.querySelector("header .user-details .user-avatar");

        userAvatar.addEventListener("mouseenter", () => {
            userNavigation.style.display = "grid";
        });
        userAvatar.addEventListener("mouseleave", () => {
            userNavigation.style.display = "none";
        });
        userNavigation.addEventListener("mouseenter", () => {
            userNavigation.style.display = "grid";
        });
        userNavigation.addEventListener("mouseleave", () => {
            userNavigation.style.display = "none";
        });
    </script>
</body>

</html>