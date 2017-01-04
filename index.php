<?php
$pageTitle = 'Main page';
include 'header.php';


echo '<a href="books.php">New book</a> <a href="author.php">New author</a>';
$query = mysqli_query($conn,'SELECT * FROM books LEFT JOIN books_authors ON books.book_id=books_authors.book_id LEFT JOIN `authors` ON books_authors.author_id=`authors`.author_id');
$result=array();
while($item=mysqli_fetch_assoc($query))
{
    $result[$item['book_id']]['book_name']=$item['book_title'];
    $result[$item['book_id']]['author'][]=$item['author_name'];
}

echo'<table class="mainTable"><tr><td>Book</td><td>Author</td></tr>';
foreach($result as $value){
    echo'<tr><td>'.$value['book_name'].'</td><td>';
    $author=array();
    foreach($value['author'] as $v){
        $author[]=$v;
    }
    echo implode(',',$author);
    echo '</td></tr>';

}
echo'</table>';
include 'footer.php';