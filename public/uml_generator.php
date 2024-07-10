<?php
require_once "../vendor/autoload.php";

use Plantuml\PlantUml;

$plantuml = new PlantUml('http://www.plantuml.com/plantuml');

if (isset($_POST['uml'])) {
    $umlCode = $_POST['uml'];
    $format = $_POST['format'] ?? 'svg';

    if ($format === 'svg') {
        header('Content-Type: image/svg+xml');
        echo $plantuml->generateImage($umlCode, PlantUml::FORMAT_SVG);
    } elseif ($format === 'png') {
        header('Content-Type: image/png');
        echo $plantuml->generateImage($umlCode, PlantUml::FORMAT_PNG);
    }

    // ファイルを削除する処理をここに追加
} else {
    echo "No UML content provided.";
}