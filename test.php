<?php

require_once __DIR__ . '/vendor/autoload.php';

use Josh\BookList\Model\DAO\BookDAO;
use Josh\BookList\Model\Database;

$pdo = (new Database())->getConnection();
$arr = (new BookDAO($pdo))->getBooks();
echo sizeof($arr);
