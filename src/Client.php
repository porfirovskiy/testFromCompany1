<?php

namespace ApiWrapper;

use ApiWrapper\URIHandler;
use GuzzleHttp\Client as GClient;

/**
 * Description of Client
 *
 * @author porfirovskiy
 */
class Client implements ClientInteface 
{
    const GET_HTTP_REQUEST_TYPE = 'GET';
    const OK_RESPONSE_STATUS = 'OK';
    const INVALID_REQUEST_RESPONSE_STATUS = 'INVALID_REQUEST';
    const NOT_FOUND_RESPONSE_STATUS = 'NOT_FOUND';
    
    protected $httpClient;
    protected $uriHandler;
    
    public function __construct(GClient $httpClient, URIHandler $uriHandler)
    {
        $this->httpClient = $httpClient;
        $this->uriHandler = $uriHandler;
    }
    
    public function getBooks(int $limit = 0, int $offset = 0): array
    {
        $books = $this->makeRequest(static::GET_HTTP_REQUEST_TYPE, $this->uriHandler->getBooksURI($limit, $offset));
        
        return $books->data->books;
    }
    
    public function getAuthors(int $limit = 0, int $offset = 0): array
    {
        $authors = $this->makeRequest(static::GET_HTTP_REQUEST_TYPE, $this->uriHandler->getAuthorsURI($limit, $offset));
        
        return $authors->data->authors;
    }
    
    public function getAuthorBooks(int $authorId, int $limit = 0, int $offset = 0): array
    {
        $authorBooks = $this->makeRequest(static::GET_HTTP_REQUEST_TYPE, $this->uriHandler->getAuthorsBooksURI($authorId, $limit, $offset));
        
        return $authorBooks->data->books;
    }
    
    protected function makeRequest(string $type, $uri): \stdClass
    {
        $response = $this->httpClient->request($type, $uri);
        $jsonResult = $response->getBody()->getContents();
        $result = json_decode($jsonResult);

        $this->checkResponseStatus($result);

        return $result;
    }
    
    /**
     * 
     * @param string $status
     * @return void
     * @throws Exception
     */
    protected function checkResponseStatus(\stdClass $response): void
    {
        if ($response->status != static::OK_RESPONSE_STATUS) {
            throw new \Exception('status: ' . $response->status . ', message: '. $response->message);
        }
    }
}
