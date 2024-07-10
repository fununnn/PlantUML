<?php
require_once "../vendor/autoload.php";
$Parsedown = new Parsedown();
$Parsedown->setSafeMode(true);
$md = <<<EOF
@startuml
Alice -> Bob: Hello
@enduml
EOF;
$htmlContent = $Parsedown->text($md);
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PlantUML Editor</title>
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
    <div class="container">
        <div class="editor-pane">
            <div id="editor"></div>
        </div>
        <div class="preview-pane">
            <div class="preview-controls">
                <button id="uml-btn">Generate UML</button>
                <button id="download-png-btn">Download PNG</button>
                <button id="download-svg-btn">Download SVG</button>
                <button id="download-txt-btn">Download TXT</button>
                <button id="cheatsheet-btn">Cheatsheet</button>
            </div>
            <div id="preview-content"></div>
        </div>
    </div>
    <script src="../node_modules/monaco-editor/min/vs/loader.js"></script>
    <script src="./js/editor.js"></script>
    <script src="./js/uml.js"></script>
</body>
</html>