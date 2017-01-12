<?php
session_name('BookStore');
session_set_cookie_params(2629743,'/','localhost',false,true);
session_start();


$conn = mysqli_connect('localhost','admin','087376401','test');
if(!$conn){
    echo 'no database';
    exit;
}
mysqli_set_charset($conn,'utf8');