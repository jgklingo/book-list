<?php

namespace Josh\BookList\Interfaces\Interfaces;
use BookList\Model\DAO\BookDAO;

class App {
    private BookDAO $bookDao;

    public function __construct() {
        $this->bookDao = new BookDAO();
    }
    public function run() {
        while (true) {

        }
    }
}
