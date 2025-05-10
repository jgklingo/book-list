<?php

namespace Josh\BookList\UI;
use Josh\BookList\Model\DAO\BookDAO;
use Josh\BookList\Model\Database;
use Josh\BookList\Model\Entity\Book;

class CLIApp {
    private Database $db;
    private BookDAO $bookDao;
    private string $options =
"Options:
    0. Exit
    1. Show all books
    2. Find book by title
    3. Add new book
    4. Update book
";

    public function __construct() {
        $this->db = new Database();
        $this->bookDao = new BookDAO($this->db->getConnection());
    }
    public function run(): void {
        $this->repl();
    }
    private function repl(): void {
        while (true) {
            echo $this->options;
            $line = trim(fgets(STDIN));
            switch ($line) {
                case "0": return;
                case "1": {
                    foreach ($this->bookDao->getBooks() as $book) {
                        $this->displayBook($book);
                    }
                    break;
                }
                case "2": {
                    echo "Title: ";
                    $title = trim(fgets(STDIN));
                    $book = $this->bookDao->getBookByTitle($title);
                    if ($book) {
                        $this->displayBook($book);
                    } else {
                        echo "Book not found\n";
                    }
                    break;
                }
                case "3": {
                    $book = $this->getBook();
                    $this->bookDao->insertBook($book);
                    break;
                }
                case "4": {
                    $book = $this->getBook();
                    $this->bookDao->updateBook($book);
                    break;
                }
                default: {
                    break;
                }
            }
            echo "\n";
        }
    }
    private function getBook(): Book {
        echo "Title: ";
        $title = trim(fgets(STDIN));
        echo "Total Pages: ";
        $totalPages = (int)trim(fgets(STDIN));
        echo "Pages Read: ";
        $pagesRead = (int)trim(fgets(STDIN));
        return new Book($title, $totalPages, $pagesRead);
    }
    private function displayBook(Book $book): void {
        echo "Title: $book->title, Total Pages: $book->totalPages, Pages Read $book->pagesRead\n";
    }
}
