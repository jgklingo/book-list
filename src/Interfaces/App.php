<?php

namespace Josh\BookList\Interfaces;
use Josh\BookList\Model\DAO\BookDAO;
use Josh\BookList\Model\Database;

class App {
    private Database $db;
    private BookDAO $bookDao;

    public function __construct() {
        $this->db = new Database();
        $this->bookDao = new BookDAO($this->db->getConnection());
    }
    public function run() {
        while (true) {

        }
    }
}
