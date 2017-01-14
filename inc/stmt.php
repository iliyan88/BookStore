<?php
require_once "DAL.php";


//take all books from db and keep them in $result -> Book Name -> author Id = author Name
function allBooksAuthors($conn){
    $stmtBooks = $conn->prepare('SELECT * FROM books LEFT JOIN books_authors ON books.book_id=books_authors.book_id LEFT JOIN `authors` ON books_authors.author_id=`authors`.author_id');
    $stmtBooks->execute();
    $results = $stmtBooks->get_result();
    $result=array();
    while($item=$row = $results->fetch_assoc()){
        $result[$item['book_id']]['book_name']=$item['book_title'];
        $result[$item['book_id']]['author'][$item['author_id']]=$item['author_name'];
    }
    return $result;
}

//select author by book ID
function authorByBookId($conn,$book_id){
    $authorBookId=$conn->prepare('SELECT * FROM `authors` LEFT JOIN books_authors ON `authors`.author_id=books_authors.author_id LEFT JOIN books ON books_authors.book_id=books.book_id WHERE books.book_id="' . $book_id . '"');
    return $authorBookId;
}

//Select all authors
function allAuthors($conn){
    $stmtAuthors=$conn->prepare('SELECT * FROM `authors`');
    return $stmtAuthors;
}

//select All books by author
function booksByAuthor($conn,$author){
    $booksByAuthor=$conn->prepare('SELECT * FROM `books` LEFT JOIN books_authors ON books.book_id=books_authors.book_id LEFT JOIN `authors` ON books_authors.author_id=`authors`.author_id WHERE `authors`.author_id="' . $author . '"');
    return $booksByAuthor;
}

//check if author exist by name
function checkAuthor($conn,$name){
    $stmtCheckAuthor = $conn->prepare('SELECT * FROM authors WHERE author_name ="' . $name . '"');
    return $stmtCheckAuthor;
}

//check author by id
function checkId($conn,$authorId){
    $checkID=$conn->prepare("SELECT * FROM `authors` WHERE author_id = '".$authorId."'");
    return $checkID;
}


//insert author
function insAuthor($conn,$name){
    $stmtInsertAuthor = $conn->prepare("INSERT INTO `authors` (author_name) VALUE ('" . $name . "')");
    return $stmtInsertAuthor;
}

//check if book exist   $queryBook="SELECT * FROM `books` WHERE book_title = '".$book."'";
function checkBook($conn,$book){
    $stmtCheckBook=$conn->prepare("SELECT * FROM `books` WHERE book_title = '".$book."'");
    return $stmtCheckBook;
}

//insert a book
function insBook($conn,$book){
    $stmtInsertBook=$conn->prepare("INSERT INTO `books`(book_title) VALUES ('".$book."')");
    return $stmtInsertBook;
}

//insert in books-author table
function insBA($conn, $bookId, $authorId){
    $stmtInsertBA=$conn->prepare("INSERT INTO `books_authors` (book_id,author_id) VALUES ('".$bookId."','".$authorId."')");
    return $stmtInsertBA;
}
