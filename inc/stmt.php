<?php
require_once "DAL.php";
////DO NOT DISPLAY ERRORS TO USER
//ini_set("display_errors", 0);
//ini_set("log_errors", 1);
//
////Define where do you want the log to go, syslog or a file of your liking with
//ini_set("error_log", dirname(__FILE__).'/php_errors.log');
//
//register_shutdown_function(function(){
//    $last_error = error_get_last();
//    if ( !empty($last_error) &&
//        $last_error['type'] & (E_ERROR | E_COMPILE_ERROR | E_PARSE | E_CORE_ERROR | E_USER_ERROR)
//    )
//    {
//        require_once('../../temp/maintenance.php');
//        exit(1);
//    }
//});
//take all books from db and keep them in $result -> Book Name -> author Id = author Name
$stmtBooks = $conn->prepare('SELECT * FROM books LEFT JOIN books_authors ON books.book_id=books_authors.book_id LEFT JOIN `authors` ON books_authors.author_id=`authors`.author_id');
$stmtBooks->execute();
$results = $stmtBooks->get_result();
$result=array();
while($item=$row = $results->fetch_assoc()){
    $result[$item['book_id']]['book_name']=$item['book_title'];
    $result[$item['book_id']]['author'][$item['author_id']]=$item['author_name'];
}

//Select all authors
$stmtAuthors=$conn->prepare('SELECT * FROM `authors`');
$stmtAuthors->execute();
$authorsResult=$stmtAuthors->get_result();



//check if author exist by name
if($_GET['author_name'] != '') {
    $name = trim($_GET['author_name']);
    $stmtCheckAuthor = $conn->prepare('SELECT * FROM authors WHERE author_name ="' . $name . '"');
    $stmtCheckAuthor->execute();
    $checkName = $stmtCheckAuthor->get_result();
//check author by id
    $checkID=mysqli_query($conn,"SELECT * FROM `authors` WHERE author_id = '".$_GET['authorId']."'");

//insert author
    if ($checkName->num_rows == 0) {
        $name = trim($_GET['author_name']);
        $stmtInsertAuthor = $conn->prepare("INSERT INTO `authors` (author_name) VALUE ('" . $name . "')");
        $stmtInsertAuthor->execute();
        $insrtAuthorResl = $stmtInsertAuthor->store_result();
    }
}
//check if book exist   $queryBook="SELECT * FROM `books` WHERE book_title = '".$book."'";
$book=trim($_POST['book_name']);
$stmtCheckBook=$conn->prepare("SELECT * FROM `books` WHERE book_title = '".$book."'");

//insert a book
$stmtInsertBook=$conn->prepare("INSERT INTO `books`(book_title) VALUES ('".$book."')");

//insert in books-author table
function insBA($conn, $bookId, $authorId){
    $stmtInsertBA=$conn->prepare("INSERT INTO `books_authors` (book_id,author_id) VALUES ('".$bookId."','".$authorId."')");
    return $stmtInsertBA;
}
