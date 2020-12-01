Test task 1.

Install package with composer:

```sh
1. Add new repo to composer json
composer config repositories.foo '{"type": "vcs", "url": "https://github.com/porfirovskiy/testFromCompany1.git"}'

2. Install package from github repo
composer require porfirovskiy/api-wrapper dev-master
```

Use in code like this:

```php
<?php

use ApiWrapper\Client;
use ApiWrapper\URIHandler;

require_once 'vendor/autoload.php';

$httpClient = new \GuzzleHttp\Client(['base_uri' => 'http://94.254.0.188:4000/']);
$uriHandler = new URIHandler();

$client = new Client($httpClient, $uriHandler);

$result = $client->getAuthors();
$result2 = $client->getAuthors(2, 1);
$result3 = $client->getBooks(4, 2);



var_dump($result);die();
```
