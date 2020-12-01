<?php

use ApiWrapper\Client;

require_once 'vendor/autoload.php';

$httpClient = new \GuzzleHttp\Client(['base_uri' => 'http://94.254.0.188:4000/']);

$result = (new Client($httpClient))->getAuthorsBooks(2);

var_dump($result);die();