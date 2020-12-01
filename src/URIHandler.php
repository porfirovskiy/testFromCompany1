<?php

namespace ApiWrapper;

/**
 * Class for operations with URI entities
 *
 * @author porfirovskiy
 */
class URIHandler implements URIHandlerInterface
{
    const BOOKS_URI = 'books';
    const AUTHORS_URI = 'authors';
    const AUTHORS_BOOKS_BEGIN_URI = 'authors/';
    const AUTHORS_BOOKS_END_URI = '/books';
    
    /**
     * Forming books URI
     * 
     * @param int $limit
     * @param int $offset
     * @return string
     */
    public function getBooksURI(int $limit, int $offset): string
    {
        return static::BOOKS_URI . $this->getURIParams($limit, $offset);
    }
    
    /**
     * Forming authors URI
     * 
     * @param int $limit
     * @param int $offset
     * @return string
     */
    public function getAuthorsURI(int $limit, int $offset): string
    {   
        return static::AUTHORS_URI . $this->getURIParams($limit, $offset);
    }
    
    /**
     * Forming author books URI
     * 
     * @param int $authorId
     * @param int $limit
     * @param int $offset
     * @return string
     */
    public function getAuthorBooksURI(int $authorId, int $limit, int $offset): string
    {
        return static::AUTHORS_BOOKS_BEGIN_URI 
                . $authorId 
                . static::AUTHORS_BOOKS_END_URI
                . $this->getURIParams($limit, $offset);
    }
    
    /**
     * Forming URI string part of params
     * 
     * @param int $limit
     * @param int $offset
     * @return string
     */
    protected function getURIParams(int $limit, int $offset): string
    {
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
        } else if ($limit === 0 && $offset === 0) {
            return '';
        }
        
        $params = http_build_query($data);
        
        return '?' . $params;
    }
}
