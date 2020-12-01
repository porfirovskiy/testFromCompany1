<?php

namespace ApiWrapper;

/**
 *
 * @author porfirovskiy
 */
interface URIHandlerInterface 
{
    public function getBooksURI(int $limit, int $offset): string;
    public function getAuthorsURI(int $limit, int $offset): string;
    public function getAuthorBooksURI(int $authorId, int $limit, int $offset): string;   
}
