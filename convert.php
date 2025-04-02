<?php 
//@todo: Make this page an html page with file preview and ability to download it (+ add CSS)

error_reporting(E_ALL);
require 'converters/DetxToTxt.php';
require 'converters/TxtToDetx.php';

header("Content-Type: text/plain");

if (isset($_POST['example'])) {
    $file = 'samples/example.detx';

    $converter = new DetxToTxt();
} else {
    $file = $_FILES["file"]["tmp_name"];

    if (isset($_POST['txt'])) {
        $converter = new DetxToTxt();
        
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
