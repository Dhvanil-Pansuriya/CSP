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
    <title>Editor Page</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<?php
include "../config.php";

if (isset($_POST['update-snippet-btn'])) {

    $snippet_id = $_GET['snippet_id'];

    $title = $_POST['snippet-title'];
    $html_code = mysqli_real_escape_string($conn, $_POST['html-textarea']);
    $css_code = mysqli_real_escape_string($conn, $_POST['css-textarea']);
    $js_code = mysqli_real_escape_string($conn, $_POST['js-textarea']);

    $updateCodeSql = "UPDATE `code_snippets` SET `title`='${title}',`html_code`='${html_code}',`css_code`='${css_code}',`js_code`='{$js_code}',`created_on`=NOW() WHERE snippet_id='${snippet_id}'";

    $result = mysqli_query($conn, $updateCodeSql) or die('Query Failed.');


}

if (isset($_GET['snippet_id'])) {

    $snippet_id = $_GET['snippet_id'];

    $getCodeSQL = "SELECT * FROM `code_snippets` WHERE snippet_id = '${snippet_id}';";
    $result = mysqli_query($conn, $getCodeSQL) or die("Query Failed.");

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        $title = $row['title'];
        $html_code = $row['html_code'];
        $css_code = $row['css_code'];
        $js_code = $row['js_code'];
        $author = $row['author'];


        ?>

        <body id="editor-page">
            <form method="post" action="<?php echo $_SERVER['REQUEST_URI'] ?>">
                <header id="editor-header">
                    <div class="editor-title">
                        <h1>
                            <input type="text" id="snippet-title" name="snippet-title" value="<?php echo $row['title']; ?>"
                                readonly>
                        </h1>
                        <button id="snippet-title-edit-btn">Edit</button>
                        <button id="snippet-title-submit-btn">Done</button>
                    </div>
                    <div class="editor-actions">
                        <button id="save-snippet-btn" name="update-snippet-btn" type="submit">Save</button>
                    </div>
                </header>
                <main>
                    <div id="editor">
                        <ul id="language-tab-bar">
                            <li class="language-tab" data-language="html" data-display="active">HTML</li>
                            <li class="language-tab" data-language="css" data-display="hidden">CSS</li>
                            <li class="language-tab" data-language="javascript" data-display="hidden">JavaScript</li>
                        </ul>
                        <div id="editor-textareas">
                            <textarea name="html-textarea" id="html-textarea" data-display="active" data-language="html"
                                onkeyup="run()" placeholder="HTML code"><?php echo $row['html_code']; ?></textarea>
                            <textarea name="css-textarea" id="css-textarea" data-display="hidden" data-language="css"
                                onkeyup="run()" placeholder="CSS code"
                                value="<?php echo $css_code; ?>"><?php echo $row['css_code']; ?></textarea>
                            <textarea name="js-textarea" id="js-textarea" data-display="hidden" data-language="javascript"
                                onkeyup="run()" placeholder="JavaScript Code"
                                value="<?php echo $js_code; ?>"><?php echo $row['js_code']; ?></textarea>
                        </div>
                    </div>
                    <div id="preview-container">
                        <h3>Output</h3>
                        <iframe id="preview" onload="run()"></iframe>
                    </div>
                </main>

            </form>
            <?php
    }

} else {
    header("location: ../");
} ?>
    <script src="../js/app.js"></script>
    <script>
        /* Editor Language Tabs */

        const languageTabBar = document.getElementById("language-tab-bar");
        const languageTabs = document.getElementsByClassName("language-tab");
        const editorTextareas = document.querySelectorAll("#editor-textareas textarea");

        for (i = 0; i < languageTabs.length; i++) {
            languageTabs[i].addEventListener("click", (e) => {
                let selectedLanguage = e.target.dataset.language;

                for (j = 0; j < editorTextareas.length; j++) {
                    if (editorTextareas[j].dataset.language == selectedLanguage) {
                        editorTextareas[j].dataset.display = "active";
                    } else {
                        editorTextareas[j].dataset.display = "hidden";
                    }

                    for (k = 0; k < languageTabs.length; k++) {
                        if (languageTabs[k].dataset.language == selectedLanguage) {
                            languageTabs[k].dataset.display = "active";
                        } else {
                            languageTabs[k].dataset.display = "hidden";
                        }
                    }
                }
            });
        }

        /* Code Editor snippet title edit button */

        const snippetTitleEditBtn = document.getElementById("snippet-title-edit-btn");
        const snippetTitleSubmitBtn = document.getElementById(
            "snippet-title-submit-btn"
        );
        const snippetTitle = document.getElementById("snippet-title");

        snippetTitleEditBtn.addEventListener("click", (e) => {
            e.preventDefault();

            snippetTitle.readOnly = false;
            snippetTitle.select();
            snippetTitleSubmitBtn.style.display = "block";
            snippetTitleEditBtn.style.display = "none";
        });

        snippetTitleSubmitBtn.addEventListener("click", (e) => {
            e.preventDefault();

            snippetTitle.readOnly = true;
            snippetTitleSubmitBtn.style.display = "none";
            snippetTitleEditBtn.style.display = "block";
        });
    </script>
</body>

</html>