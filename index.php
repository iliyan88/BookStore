<?php
include "inc/function.php";
//DO NOT DISPLAY ERRORS TO USER
ini_set("display_errors", 0);
ini_set("log_errors", 1);

//Define where do you want the log to go, syslog or a file of your liking with
ini_set("error_log", dirname(__FILE__).'/php_errors.log');

register_shutdown_function(function(){
    $last_error = error_get_last();
    if ( !empty($last_error) &&
        $last_error['type'] & (E_ERROR | E_COMPILE_ERROR | E_PARSE | E_CORE_ERROR | E_USER_ERROR)
    )
    {
        require_once('maintenance.php');
        exit(1);
    }
});


$page='';
switch  ($_GET['p']){
    case 'index_public':
        $page='index_public';
        break;
    case 'authors';
        $page='authors';
        break;
    case 'new-book';
        $page='new-book';
        break;
    case'author-books';
        $page = 'author-books';
        break;
    default:
        $page='index_public';
        break;




}
$data=array();
$data['title']='Books';
$data['content']='temp/'.$page.'.php';
render($data,'temp/layouts/def_layout.php');
echo '<pre>'.print_r($isThereBook,true).'</pre>';
