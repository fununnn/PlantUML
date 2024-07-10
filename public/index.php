<?php
require_once "../vendor/autoload.php";
require_once "../config/config.php";

$pageConfig = json_decode(file_get_contents("../config/pages.json"), true);
$currentPage = $_GET['page'] ?? 'home';

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
    <nav>
        <?php foreach ($pageConfig as $pageName => $pageData): ?>
            <a href="?page=<?php echo $pageName; ?>"><?php echo $pageData['title']; ?></a>
        <?php endforeach; ?>
    </nav>
    
<div class="container">
    <?php if ($currentPage === 'editor'): ?>
        <div class="editor-container">
            <div class="editor-pane">
                <div id="editor"></div>
            </div>
            <div class="preview-pane">
                <div class="preview-controls">
                    <!-- ボタンここ -->
                </div>
                <div id="preview-content"></div>
            </div>
        </div>
    <?php elseif ($currentPage === 'cheatsheet'): ?>
        <?php include "../templates/cheatsheet.php"; ?>
    <?php else: ?>
        <h1><?php echo $pageConfig[$currentPage]['title']; ?></h1>
        <p><?php echo $pageConfig[$currentPage]['content']; ?></p>
    <?php endif; ?>
</div>

    <script src="../node_modules/monaco-editor/min/vs/loader.js"></script>
    <script src="./js/editor.js"></script>
    <script src="./js/uml.js"></script>
</body>
</html>