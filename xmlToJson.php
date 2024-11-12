<?php
$xmlfile = 'lennujaamad.xml';
$xml = simplexml_load_file($xmlfile);
$json = json_encode($xml, JSON_PRETTY_PRINT);
header('Content-Type: application/json');
echo $json;
?>