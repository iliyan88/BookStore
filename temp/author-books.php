<?php
require_once "inc/stmt.php";

$authorId=($_GET['author_id']);
$checkIdResult= checkId($conn,$authorId);
$checkIdResult->execute();
$idResult=$checkIdResult->get_result();
if($idResult->num_rows !=0) {

    $bookByAuth=booksByAuthor($conn,$authorId);
    $bookByAuth->execute();
    $bookAuthor=$bookByAuth->get_result();
    echo "<table><tr><td>Book</td><td>Autors</td></tr>";
    while ($a=$bookAuthor->fetch_assoc()) {
        echo '<tr><td>' . $a['book_title'] . '</td><td>';
        $bookId=intval($a['book_id']);
        $authorsByB=authorByBookId($conn,$bookId);
        $authorsByB->execute();
        $authorByBook=$authorsByB->get_result();
        while ($bAuthor=$authorByBook->fetch_assoc()) {
            //echo 'asd';
            echo '<a href="index.php?p=author-books&author_id='.$bAuthor['author_id'].'">'.$bAuthor['author_name'].'</a> ';
        }
    }
    echo "</td></tr></table>";
}
else{
    header('Location: index.php');
    exit();
}