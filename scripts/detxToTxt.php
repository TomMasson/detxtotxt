<?php

require __DIR__."/../converters/DetxToTxt.php";

$filePath = $argv[1] ?? __DIR__.'/../samples/example.detx';

$converter = new DetxToTxt();

try {
    echo $converter->getResult($filePath);
} catch (\Exception $exception) {
    exit('An error has occurred while converting your file. Please try again later');
}
?>