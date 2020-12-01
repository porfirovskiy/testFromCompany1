<?php

namespace ApiWrapper;

/**
 * Description of URIHandler
 *
 * @author porfirovskiy
 */
class URIHandler 
{
    const BOOKS_URI = 'books';
    const AUTHORS_URI = 'authors';
    const AUTHORS_BOOKS_BEGIN_URI = 'authors/';
    const AUTHORS_BOOKS_END_URI = '/books';
    
    public function getBooksURI(int $limit, int $offset): string
    {
        return static::BOOKS_URI . $this->getURIParams($limit, $offset);
    }
    
    public function getAuthorsURI(int $limit, int $offset): string
    {   
        return static::AUTHORS_URI . $this->getURIParams($limit, $offset);
    }
    
    public function getAuthorsBooksURI(int $authorId, int $limit, int $offset): string
    {
        return static::AUTHORS_BOOKS_BEGIN_URI 
                . $authorId 
                . static::AUTHORS_BOOKS_END_URI
                . $this->getURIParams($limit, $offset);
    }
    
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
