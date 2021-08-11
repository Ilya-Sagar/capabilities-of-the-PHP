<?php

$xml = simplexml_load_file('dataset.xml');

foreach ($xml as $item) {
    echo $item->first_name . ' ' . $item->email;
    echo "\n";
}

$saveXml = $xml->saveXML();

file_put_contents('newDataset.xml', $saveXml);
