<?php
    $connect = mysqli_connect(
        'localhost',
        'root', 
        '', // password
        'fpl_database' // database name
    );

    if (!$connect) {
        die('Connection failed: ' . mysqli_connect_error());
    }
?>