<?php echo  '<title>'.$data['title'].'</title>';
include "inc/stmt.php";
?>

<table><tr><td>Books</td><td>Authors</td></tr>
<?php

if($checkID->num_rows !=0) {
    $asd = $_GET['authorId'];
    $quer = mysqli_query($conn, 'SELECT * FROM `books` LEFT JOIN books_authors ON books.book_id=books_authors.book_id LEFT JOIN `authors` ON books_authors.author_id=`authors`.author_id WHERE `authors`.author_id="' . $asd . '"');

    echo '<a href="author-books.php">Books</a>';
    echo "<table><tr><td>Book</td><td>Autors</td></tr>";
    while ($a = mysqli_fetch_assoc($quer)) {
        echo '<tr><td>' . $a['book_title'] . '</td><td>';
        $authorsQry = 'SELECT * FROM `books` LEFT JOIN `books_authors` ON books.book_id=books_authors.book_id LEFT JOIN `authors` ON books_authors.author_id=`authors`.author_id WHERE books.book_id="' . $a['book_id'] . '"';
        $authors = mysqli_query($conn, $authorsQry);
        while ($aa = mysqli_fetch_assoc($authors)) {
            echo '<a href="author-author-books.php?authorId='.$aa['author_id'].'">' .$aa['author_name']. '</a> ';
        }
    }
    echo "</td></tr></table>";
}
else{
    header('Location: author-books.php');
    exit();
}