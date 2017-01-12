<?php
require_once 'inc/stmt.php';
?>
<form method="post">
    <div>
        <label for="book_name">Book name</label>
        <input type="text" name="book_name" />
    </div>
    <div>
        <select name="authors[]" multiple>
            <?php
            while($q=$authorsResult->fetch_assoc())
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
    $authors=array();
    if($isThereBook->num_rows == 0){
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