<?php declare(strict_types=1);

namespace ApiWrapper\Tests;

use ApiWrapper\Client;
use ApiWrapper\URIHandler;
use GuzzleHttp\Client as GClient;
use PHPUnit\Framework\TestCase;

class AuthorsTest extends TestCase
{
    public function testCanGetAuthors(): void
    {
        $httpClient = new GClient(['base_uri' => 'http://94.254.0.188:4000/']);
        $uriHandler = new URIHandler();

        $client = new Client($httpClient, $uriHandler);

        $result = $client->getAuthors();
        $this->assertSame(2, count($result));
        
        $resultLimit = $client->getAuthors(1);
        $this->assertSame(1, count($resultLimit));
        
        $resultLimitOffset = $client->getAuthors(2, 1);
        $this->assertSame(1, count($resultLimitOffset));
    }
}

