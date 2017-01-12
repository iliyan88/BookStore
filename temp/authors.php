<?php
////DO NOT DISPLAY ERRORS TO USER
//ini_set("display_errors", 0);
//ini_set("log_errors", 1);
//
////Define where do you want the log to go, syslog or a file of your liking with
//ini_set("error_log", dirname(__FILE__).'/php_errors.log');
//
//register_shutdown_function(function(){
//    $last_error = error_get_last();
//    if ( !empty($last_error) &&
//        $last_error['type'] & (E_ERROR | E_COMPILE_ERROR | E_PARSE | E_CORE_ERROR | E_USER_ERROR)
//    )
//    {
//        require_once('maintenance.php');
//        exit(1);
//    }
//});
?>
<form method="get" >
    <label for="author_name">Author</label>
    <input type="text" name="author_name" />
    <input type="submit" value="submit" />
</form>
<table style="border:solid">
    <tr><td>Authors</td></tr>
<?php
require_once "inc/stmt.php";
while ($q = mysqli_fetch_assoc($authorsResult)) {
    echo '<tr><td><a href="index.php?authorId=' . $q['author_id'] . '">' . $q['author_name'] . '</a></td></tr>';
}
if($_GET['author_name']){
    $newAuthor=trim($_GET['author_name']);
    if(strlen($newAuthor) < 3){
        echo 'Name should be more then 2 chars';
    }
    else {
        if ($checkName->num_rows == 0) {
            if ($insrtAuthorResl == 1) {
                echo 'Success </br>';
                echo $_GET['author_name'];
            }
        }
        else {
            echo 'Author with that name already exist';
            }
        }

        echo '</table>';
}