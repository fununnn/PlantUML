<?php
require_once "../config/config.php";

if (isset($_POST['uml'])) {
    $uml = $_POST['uml'];
    $encodedUml = urlencode($uml);
    $url = PLANTUML_SERVER . "/png/" . $encodedUml;
    
    $image = file_get_contents($url);
    
    header("Content-Type: image/png");
    echo $image;
} else {
    echo "No UML content provided.";
}