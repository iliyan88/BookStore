<?php
$data['title']='New Book';
require_once 'inc/stmt.php';
?>
<form method="POST" >
    <div>
        <label for="book_name">Book name</label>
        <input type="text" name="book_name" />
    </div>
    <div>
        <select name="authors[]" multiple>
            <?php
            $stmtAuthors= allAuthors($conn);
            $stmtAuthors->execute();
            $authorsResult=$stmtAuthors->get_result();
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
    $stmtCheckBook=checkBook($conn,$book);
    $stmtCheckBook->execute();
    $bookResult=$stmtCheckBook->get_result();
    $isBookIdExist=$bookResult->num_rows;
    if($isBookIdExist == 0){
        $stmtInsertBook=insBook($conn,$book);
        $stmtInsertBook->execute();
        $insrtBookId=$stmtInsertBook->insert_id;
        if($insrtBookId != 0){
            echo 'Book added successfully';
            foreach ($_POST['authors'] as $authorID) {
                $stmtInsertBA=insBA($conn,$insrtBookId,$authorID);
                $stmtInsertBA->execute();
                $result=$stmtInsertBA->get_result();
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