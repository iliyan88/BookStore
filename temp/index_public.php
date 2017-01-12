<?php echo  '<title>'.$data['title'].'</title>';
include "inc/stmt.php";
?>

<table class="mainTable"><tr><td>Book</td><td>Author</td></tr>
<?php
foreach($result as $item){
    echo'<tr><td>'.$item['book_name'].'</td><td>';
    foreach ($item['author'] as $key => $value) {
        echo '<a href="index.php?p=books='.$key.'">'.$value.'</a> ';
        }
    echo '</td></tr>';
    }
?>
</table>`