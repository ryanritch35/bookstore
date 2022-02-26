<?php
    function check_page_path(){
        $path = $_SERVER['PHP_SELF'];
        if ($path == '/bookstore/index.php'){
            return './index.php';
        }
        return '../index.php';
    }

?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Store</title>
    <style>
    table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
    }

    td, th {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
    }
    th {text-align: center;}
    button:hover {cursor: pointer;}
    label {
        display: inline-block;
        width: 75px;
    }

    .book_name {margin-bottom: 10px;}
    .book_isbn {margin-bottom: 10px;}
    .book_author {margin-bottom: 10px;}
    .book_genre {margin-bottom: 10px;}
    .book_type {margin-bottom: 10px;}
    .book_price {margin-bottom: 10px;}
    .from-add {margin-bottom: 10px;}
    .publisher-username {margin-bottom: 10px;}
    .publisher-password {margin-bottom: 10px;}
    .publisher_signup-name {margin-bottom: 10px;}
    .publisher-signup-username {margin-bottom: 10px;}
    .publisher-signup-password {margin-bottom: 10px;}
    .publisher-signup-address {margin-bottom: 10px;}
    .publisher-signup-phone {margin-bottom: 10px;}

    .center {
        position: absolute;
        left: 50%;
        top: 30%;
        transform: translate(-50%, -50%);
        border: 2px solid #000;
        padding: 10px;
        border-radius: 10px;
    }

    .index-center {text-align: center;}
    .book_author-checkbox{
        margin-left: 80px;
        margin-top: 10px;
        border:1px solid #000; 
        width:150px; 
        height: 100px; 
        overflow-y: scroll; 
    }
    

</style>
</head>
<body>
    <div class="title-container">
        <h1 class="title-col"><a href="<?php echo check_page_path(); ?>" style="text-decoration: none; color: black; ">BookStore: DB2 Project</a></h1>
    </div>
    <hr>