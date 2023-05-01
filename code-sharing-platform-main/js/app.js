/* Preview of code */

function run() {
  const preview = document.getElementById("preview");
  const htmlCode = document.getElementById("html-textarea").value;
  const cssCode = document.getElementById("css-textarea").value;
  const jsCode = document.getElementById("js-textarea").value;

  preview.contentDocument.body.innerHTML =
    htmlCode + "<style>" + cssCode + "</style>";
  preview.contentWindow.eval(jsCode);
}
