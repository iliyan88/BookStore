<?php
$pageTitle='Add new book';
include "header.php";
$query = mysqli_query($conn,'SELECT * FROM `authors`');

?>
<a href="books.php">Books</a>
<form method="post">
    <div>
    <label for="book_name">Book name</label>
    <input type="text" name="book_name" />
    </div>
    <div>
    <select name="authors[]" multiple>
        <?php
        while($q=mysqli_fetch_assoc($query))
        {
            echo '<option value="'.$q['author_id'].'">'.$q['author_name'].'</option>';
        }
        ?>
    </select>
    </div>
    <input type="submit" value="submit" />
</form>
<?php
if($_POST){
    $book=trim($_POST['book_name']);
    $queryBook="SELECT * FROM `books` WHERE book_title = '".$book."'";
    $checkBook=mysqli_query($conn,$queryBook);
    $authors=array();
    if($checkBook->num_rows == 0){
        if(mysqli_query($conn,"INSERT INTO `books`(book_title) VALUES ('".$_POST['book_name']."')") === true){
            echo 'Book added successfully';
            $lastBookId=mysqli_fetch_assoc(mysqli_query($conn,"SELECT LAST_INSERT_ID()"));
            foreach ($_POST['authors'] as $authorID) {
                mysqli_query($conn,"INSERT INTO `books_authors` (book_id,author_id) VALUES ('".$lastBookId['LAST_INSERT_ID()']."','".$authorID."')");
            }
        }
        else{
            echo 'Error in adding the book';
        }

    }
    else{
        echo "Book already exist";
    }
}



include "footer.php";