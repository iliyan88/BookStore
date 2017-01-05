<?php
$pageTitle = 'Authors';
include 'header.php';
?>

<form method="get">
    <label for="author_name">Author</label>
    <input type="text" name="author_name" />
    <input type="submit" value="submit" />
</form>
<table>
    <tr><td>Authors</td></tr>
<?php

$query = mysqli_query($conn,'SELECT * FROM `authors`');
while($q=mysqli_fetch_assoc($query))
{
    echo '<tr><td><a href="author-books.php?authorId='.$q['author_id'].'">'.$q['author_name'].'</a></td></tr>';
}
echo '</table>';

if($_GET){
    $newAuthor=trim($_GET['author_name']);
   if(strlen($newAuthor) < 3){
       echo 'Name should be more then 2 chars';
   }
    else{
        $checkName=mysqli_query($conn,"SELECT * FROM `authors` WHERE author_name = '".$newAuthor."'");
        if($checkName->num_rows == 0 ){
            $insertName = "INSERT INTO `authors` (author_name) VALUE ('".$newAuthor."')";
            if($conn->query($insertName) === true){
                echo 'Successfully added author';
            }
            else{
                echo 'Unsuccessful attempt to add new author';
            }
        }
        else{
            echo 'Author with that name already exist';
        }
    }

}
include "footer.php";
