<?php

use ApiWrapper\Client;
use ApiWrapper\URIHandler;

require_once 'vendor/autoload.php';

$httpClient = new \GuzzleHttp\Client(['base_uri' => 'http://94.254.0.188:4000/']);
$uriHandler = new URIHandler();

$result = (new Client($httpClient, $uriHandler))->getAuthorBooks(2, 1);

var_dump($result);die();