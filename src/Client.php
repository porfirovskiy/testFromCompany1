<?php

namespace ApiWrapper;

use GuzzleHttp\Client as GClient;

/**
 * Class for mapping http requests into array data for users
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
    
    /**
     * 
     * @param GClient $httpClient
     * @param \ApiWrapper\URIHandler $uriHandler
     */
    public function __construct(GClient $httpClient, URIHandler $uriHandler)
    {
        $this->httpClient = $httpClient;
        $this->uriHandler = $uriHandler;
    }
    
    /**
     * Get books by params
     * 
     * @param int $limit
     * @param int $offset
     * @return array
     */
    public function getBooks(int $limit = 0, int $offset = 0): array
    {
        $books = $this->makeRequest(static::GET_HTTP_REQUEST_TYPE, $this->uriHandler->getBooksURI($limit, $offset));
        
        return $books->data->books;
    }
    
    /**
     * Get authors by params
     * 
     * @param int $limit
     * @param int $offset
     * @return array
     */
    public function getAuthors(int $limit = 0, int $offset = 0): array
    {
        $authors = $this->makeRequest(static::GET_HTTP_REQUEST_TYPE, $this->uriHandler->getAuthorsURI($limit, $offset));
        
        return $authors->data->authors;
    }
    
    /**
     * Get author books by params
     * 
     * @param int $authorId
     * @param int $limit
     * @param int $offset
     * @return array
     */
    public function getAuthorBooks(int $authorId, int $limit = 0, int $offset = 0): array
    {
        $authorBooks = $this->makeRequest(static::GET_HTTP_REQUEST_TYPE, $this->uriHandler->getAuthorsBooksURI($authorId, $limit, $offset));
        
        return $authorBooks->data->books;
    }
    
    /**
     * Make http request by params
     * 
     * @param string $type
     * @param type $uri
     * @return \stdClass
     */
    protected function makeRequest(string $type, $uri): \stdClass
    {
        $response = $this->httpClient->request($type, $uri);
        $jsonResult = $response->getBody()->getContents();
        $result = json_decode($jsonResult);

        $this->checkResponseStatus($result);

        return $result;
    }
    
    /**
     * Check response status from server
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
