<?php echo  '<title>'.$data['title'].'</title>';
include "inc/stmt.php";
?>

<table><tr><td>Books</td><td>Authors</td></tr>
<?php
foreach($result as $items){
    echo '<tr><td>'.$items['book_name'].'</td><td>';
    foreach ($items['author'] as $key => $item)
    {
        echo '<a href="index.php?p=authors&authorId='.$key.'">'.$item.'</a> ';
    }
    echo '</td></tr>';
}
?>
</table>