<?php
session_name('BookStore');
session_set_cookie_params(2629743,'/','localhost',false,true);
session_start();
echo  '<title>'.$pageTitle.'</title>';

$conn = mysqli_connect('localhost','admin','087376401','test');
if(!$conn){
    echo 'no database';
    exit;
}
mysqli_set_charset($conn,'utf8');



?>
<!DOCTYPE html>
<html>
<head>
    <title>Zaken</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css" />
    <link rel="stylesheet" href="css/index.css" />
    <script type="text/javascript" src="js/jquery-3.1.1.js"></script>
    <script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>
    <script type="text/javascript" src="js/index.js"></script>
</head>
<body>