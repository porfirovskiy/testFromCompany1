<?php declare(strict_types=1);

namespace ApiWrapper\Tests;

use ApiWrapper\Client;
use ApiWrapper\URIHandler;
use GuzzleHttp\Client as GClient;
use PHPUnit\Framework\TestCase;

class AuthorBooksTest extends TestCase
{
    public function testCanGetAuthorBooks(): void
    {
        $httpClient = new GClient(['base_uri' => 'http://94.254.0.188:4000/']);
        $uriHandler = new URIHandler();

        $client = new Client($httpClient, $uriHandler);

        $result = $client->getAuthorBooks(1);
        $this->assertSame(6, count($result));
        
        $resultLimit = $client->getAuthorBooks(1, 3);
        $this->assertSame(3, count($resultLimit));
        
        $resultLimitOffset = $client->getAuthorBooks(2, 4, 1);
        $this->assertSame(3, count($resultLimitOffset));
    }
}

