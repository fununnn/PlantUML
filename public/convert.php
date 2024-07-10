<?php
require_once "../vendor/autoload.php";

$Parsedown = new Parsedown();
$Parsedown->setSafeMode(true);

if (isset($_POST['markdown'])) {
    $md = $_POST['markdown'];
    $htmlContent = $Parsedown->text($md);
    echo $htmlContent;
} else {
    echo "No markdown content provided.";
}