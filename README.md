Test task 1.

Use like this:

```php
<?php

use ApiWrapper\Client;
use ApiWrapper\URIHandler;

require_once 'vendor/autoload.php';

$httpClient = new \GuzzleHttp\Client(['base_uri' => 'http://94.254.0.188:4000/']);
$uriHandler = new URIHandler();

$client = (new Client($httpClient, $uriHandler));
$result = $client->getAuthors();

var_dump($result);die();
```