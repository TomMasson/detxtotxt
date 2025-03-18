<?php 
//@todo: Make this page an html page with file preview and ability to download it

error_reporting(E_ALL);
require 'converters/DextToTxt.php';
require 'converters/TxtToDetx.php';

header("Content-Type: text/plain");

if (isset($_POST['example'])) {
    $file = 'samples/example.detx';

    $converter = new DextToTxt();
} else {
    $file = $_FILES["file"]["tmp_name"];

    if (isset($_POST['txt'])) {
        $converter = new DextToTxt();
        
    } elseif (isset($_POST['detx'])) {
        $converter = new TxtToDetx();
    }
}


if (!$file) {
    exit('An error has occured while loading your file. Please try again.');
}

try {
    echo $converter->getResult($file);
} catch (\Exception $exception) {
    exit('An error has occurred while converting your file. Please try again later');
}
