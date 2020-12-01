<?php

namespace ApiWrapper;

/**
 *
 * @author porfirovskiy
 */
interface ClientInteface {
    
    public function getBooks(): array;
    
    public function getAuthors(): array;
    
    public function getAuthorBooks(int $authorId): array;
    
}
