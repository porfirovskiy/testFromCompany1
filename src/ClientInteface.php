<?php

namespace ApiWrapper;

/**
 *
 * @author porfirovskiy
 */
interface ClientInteface {
    
    public function getBooks(int $limit = 0, int $offset = 0): array;
    
    public function getAuthors(int $limit = 0, int $offset = 0): array;
    
    public function getAuthorBooks(int $authorId, int $limit = 0, int $offset = 0): array;
    
}
