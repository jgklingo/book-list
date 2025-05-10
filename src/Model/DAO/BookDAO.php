<?php

namespace Josh\BookList\Model\DAO;
use Josh\BookList\Model\Entity\Book;
use PDO;

class BookDAO
{
    private PDO $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }
    public function getBookByTitle(string $title): ?Book {
        $sql = 'SELECT * FROM books WHERE title = :title';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':title', $title);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            return new Book($row['Title'], $row['TotalPages'], $row['PagesRead']);
        } else {
            return null;
        }
    }
    public function getBooks(): array {
        $sql = 'SELECT * FROM books';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $books = [];
        foreach ($rows as $row) {
            $books[] = new Book($row['Title'], $row['TotalPages'], $row['PagesRead']);
        }
        return $books;
    }
    public function insertBook(Book $book): void {
        $sql = 'INSERT INTO books VALUES (:title, :totalPages, :pagesRead)';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':title', $book->title);
        $stmt->bindValue(':totalPages', $book->totalPages);
        $stmt->bindValue(':pagesRead', $book->pagesRead);
        $stmt->execute();
    }
    public function updateBook(Book $book): void {
        $sql = 'UPDATE books SET TotalPages = :totalPages, PagesRead = :pagesRead WHERE Title = :title';
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':title', $book->title);
        $stmt->bindValue(':totalPages', $book->totalPages);
        $stmt->bindValue(':pagesRead', $book->pagesRead);
        $stmt->execute();
    }
}
