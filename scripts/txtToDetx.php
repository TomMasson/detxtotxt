<?php

require __DIR__."/../converters/TxtToDetx.php";

$filePath = $argv[1] ?? __DIR__.'/../samples/example.txt';

$converter = new TxtToDetx();

try {
    echo $converter->getResult($filePath);
} catch (\Exception $exception) {
    exit('An error has occurred while converting your file. Please try again later');
}
?>