<?php
require_once "../config/config.php";

if (isset($_POST['uml']) && isset($_POST['format'])) {
    $uml = $_POST['uml'];
    $format = $_POST['format'];
    $encodedUml = urlencode($uml);
    
    switch ($format) {
        case 'png':
            $url = PLANTUML_SERVER . "/png/" . $encodedUml;
            $contentType = "image/png";
            break;
        case 'svg':
            $url = PLANTUML_SERVER . "/svg/" . $encodedUml;
            $contentType = "image/svg+xml";
            break;
        case 'txt':
            $contentType = "text/plain";
            echo $uml;
            exit;
        default:
            echo "Invalid format";
            exit;
    }
    
    $content = file_get_contents($url);
    
    header("Content-Type: " . $contentType);
    header("Content-Disposition: attachment; filename=diagram." . $format);
    echo $content;
} else {
    echo "No UML content or format provided.";
}