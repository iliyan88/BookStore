<?php
$pageTitle='All available books in store!';
include "header.php";
$allbookqry= "SELECT * FROM `books` LEFT JOIN books_authors ON books.book_id=books_authors.book_id LEFT JOIN `authors` ON books_authors.author_id=`authors`.author_id";
$booskResult=mysqli_query($conn,$allbookqry);
$booksAuthors=array();
while($books=mysqli_fetch_assoc($booskResult)){
    $booksAuthors[$books['book_id']]['book_title']=$books['book_title'];
    $booksAuthors[$books['book_id']]['author'][$books['author_id']]=$books['author_name'];
}

echo '<a href="new-book.php">New book</a> <a href="author.php">New author</a>';
echo '<table><tr><td>Books</td><td>Authors</td></tr>';

    foreach($booksAuthors as $items){
        echo '<tr><td>'.$items['book_title'].'</td><td>';
        foreach ($items['author'] as $key => $item)
        {
            echo '<a href="author-books.php?authorId='.$key.'">'.$item.'</a> ';
        }
        echo '</td></tr>';
    }
echo '</table>';


include "footer.php";