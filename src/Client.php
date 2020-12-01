<?php

namespace ApiWrapper;

/**
 * Description of Client
 *
 * @author porfirovskiy
 */
class Client implements ClientInteface 
{
    const GET_HTTP_REQUEST_TYPE = 'GET';
    const BOOKS_URI = 'books';
    const AUTHORS_URI = 'authors';
    const AUTHORS_BOOKS_BEGIN_URI = 'authors/';
    const AUTHORS_BOOKS_END_URI = '/books';
    
    protected $httpClient;
    
    public function __construct(\GuzzleHttp\Client $httpClient)
    {
        $this->httpClient = $httpClient;
    }
    
    public function getBooks(int $limit = 0, int $offset = 0): array
    {
        $response = $this->httpClient->request(static::GET_HTTP_REQUEST_TYPE, static::BOOKS_URI);
        $jsonBooks = $response->getBody()->getContents();
        $books = json_decode($jsonBooks);
        
        return $books->data->books;
    }
    
    public function getAuthors(): array
    {
        $response = $this->httpClient->request(static::GET_HTTP_REQUEST_TYPE, static::AUTHORS_URI);
        $jsonAuthors = $response->getBody()->getContents();
        $authors = json_decode($jsonAuthors);
        
        return $authors->data->authors;
    }
    
    public function getAuthorBooks(int $authorId): array
    {
        $response = $this->httpClient->request(static::GET_HTTP_REQUEST_TYPE, $this->getAuthorsBooksURI($authorId));
        $jsonAuthorBooks = $response->getBody()->getContents();
        $authorBooks = json_decode($jsonAuthorBooks);
        
        return $authorBooks->data->books;
    }
    
    protected function getAuthorsBooksURI(int $authorId): string
    {
        return static::AUTHORS_BOOKS_BEGIN_URI . $authorId . static::AUTHORS_BOOKS_END_URI;
    }
    
    protected function getBooksURI(int $limit, int $offset): string
    {   
        static::BOOKS_URI . $this->getURIParams($limit, $offset);
    }
    
    protected function getAuthorsURI(int $limit, int $offset): string
    {   
        static::AUTHORS_URI . $this->getURIParams($limit, $offset);
    }
    
    protected function getURIParams(int $limit, int $offset): string
    {
        $params = '';
        
        if ($limit !== 0 && $offset !== 0) {
            $data = [
               'limit' => $limit,
               'offset' => $offset
            ];
            
        } else if ($limit !== 0 && $offset === 0) {
            $data = [
               'limit' => $limit
            ];
        } else if ($limit === 0 && $offset !== 0) {
            $data = [
               'offset' => $offset
            ];
        }
        
        $params = http_build_query($data);
        
        return '?' . $params;
    }

}
