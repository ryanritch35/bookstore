<?php
    $host = 'localhost';
    $host_user = 'root';
    $host_password = '';
    $host_db = 'bookstore';

    $conn = mysqli_connect($host, $host_user, $host_password, $host_db);

    if(!$conn){
        echo 'Bad  connection'. mysqli_connect_error();
        echo 'Cannot find the link';
    }
?>