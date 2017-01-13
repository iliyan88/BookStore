<!DOCTYPE html>
<html>
<head>
<!--    <title>--><?//= $data['title']; ?><!--</title>-->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css" />
    <link rel="stylesheet" href="css/index.css" />
    <script type="text/javascript" src="js/jquery-3.1.1.js"></script>
    <script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>
    <script type="text/javascript" src="js/index.js"></script>
</head>
<body>
<header>
    <div>
        <a href="index.php">Index</a>
        <a href="index.php?p=authors">Authors</a>
        <a href="index.php?p=author-books">Books</a>
        <a href="index.php?p=new-book">New book</a>
    </div>
</header>
    <div>
        <?php
        include $data['content'];
        ?>
    </div>
<footer>
    <div>
        <p>All Rights Reserved.</p>
    </div>
</footer>
</body>
</html>
