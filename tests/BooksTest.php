<?php declare(strict_types=1);

namespace ApiWrapper\Tests;

use ApiWrapper\Client;
use ApiWrapper\URIHandler;
use GuzzleHttp\Client as GClient;
use PHPUnit\Framework\TestCase;

class BooksTest extends TestCase
{
    public function testCanGetBooks(): void
    {
        $httpClient = new GClient(['base_uri' => 'http://94.254.0.188:4000/']);
        $uriHandler = new URIHandler();

        $client = new Client($httpClient, $uriHandler);

        $result = $client->getBooks();
        $this->assertSame(10, count($result));
        
        $resultLimit = $client->getBooks(4);
        $this->assertSame(4, count($resultLimit));
        
        $resultLimitOffset = $client->getBooks(6, 2);
        $this->assertSame(6, count($resultLimitOffset));
    }
}

