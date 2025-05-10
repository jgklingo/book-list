<?php

namespace Josh\BookList\Model\Entity;

class Book
{
    public string $title;
    public int $totalPages;
    public int $pagesRead;

    public function __construct(string $title, int $totalPages = null, int $pagesRead = null) {
        $this->title = $title;
        $this->totalPages = $totalPages;
        $this->pagesRead = $pagesRead;
    }
}