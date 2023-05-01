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

if (isset($_POST["save-snippet-btn"])) {
    include "../config.php";
    include "../functions.php";

    $snippet_id = uniqueId();
    $title = $_POST['snippet-title'];
    $html_code = mysqli_real_escape_string($conn, $_POST['html-textarea']);
    $css_code = mysqli_real_escape_string($conn, $_POST['css-textarea']);
    $js_code = mysqli_real_escape_string($conn, $_POST['js-textarea']);
    $title = $_POST['snippet-title'];
    $username = $_SESSION['username'];

    $sql = "INSERT INTO `code_snippets`(`snippet_id`, `title`, `html_code`, `css_code`, `created_on`, `author`) VALUES ('${snippet_id}','${title}','${html_code}','${css_code}',NOW(),'${username}')";

    $result = mysqli_query($conn, $sql) or die("Query Failed");

    if ($result) {
        echo "<div id ='code-successful-dialog'>Code inserted Successfully.</div>";

        header("location: ./update.php?snippet_id=${snippet_id}");
    }
    ;
}

?>

<body id="editor-page">
    <form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
        <header id="editor-header">
            <div class="editor-title">
                <h1>
                    <input type="text" id="snippet-title" name="snippet-title" value="untitled" readonly>
                </h1>
                <div class="title-actions">
                    <button id="snippet-title-edit-btn">Edit</button>
                    <button id="snippet-title-submit-btn">Done</button>
                </div>
            </div>
            <div class="editor-actions">
                <button id="save-snippet-btn" name="save-snippet-btn" type="submit">Save</button>
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
                        onkeyup="run()" placeholder="HTML code"></textarea>
                    <textarea name="css-textarea" id="css-textarea" data-display="hidden" data-language="css"
                        onkeyup="run()" placeholder="CSS code"></textarea>
                    <textarea name="js-textarea" id="js-textarea" data-display="hidden" data-language="javascript"
                        onkeyup="run()" placeholder="JavaScript Code"></textarea>
                </div>
            </div>
            <div id="preview-container">
                <h3>Output</h3>
                <iframe id="preview"></iframe>
            </div>
        </main>

    </form>
    <script src="../js/app.js"></script>
    <script>
        /* Editor Language Tabs */

        let languageTabBar = document.getElementById("language-tab-bar");
        let languageTabs = document.getElementsByClassName("language-tab");
        let editorTextareas = document.querySelectorAll("#editor-textareas textarea");

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