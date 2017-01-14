<form method="get">
    <label for="author_name">Author</label>
    <input type="hidden" name="p" value="authors"/>
    <input type="text" name="author_name" />
    <input type="submit" value="submit" />
</form>
<table style="border:solid">
    <tr><td>Authors</td></tr>
<?php
require_once "inc/stmt.php";
$stmtAuthors= allAuthors($conn);
$stmtAuthors->execute();
$authorsResult=$stmtAuthors->get_result();
while ($q = mysqli_fetch_assoc($authorsResult)) {
    echo '<tr><td><a href="index.php?authorId=' . $q['author_id'] . '">' . $q['author_name'] . '</a></td></tr>';
}
if($_GET['author_name']){
    $newAuthor=trim($_GET['author_name']);
    if(strlen($newAuthor) < 3){
        echo 'Name should be more then 2 chars';
    }
    else {
        $stmtCheckAuthor= checkAuthor($conn,$newAuthor);
        $stmtCheckAuthor->execute();
        $checkName = $stmtCheckAuthor->get_result();
        if ($checkName->num_rows == 0) {
            $stmtInsertAuthor=insAuthor($conn,$newAuthor);
            $stmtInsertAuthor->execute();
            $asd=$stmtInsertAuthor->affected_rows;
            if ($asd) {
                echo 'Success </br>';
                echo $newAuthor;
            }
            else{
                echo 'error in adding the author';
            }
        }
        else {
            echo 'Author with that name already exist';
            }
        }

        echo '</table>';
}