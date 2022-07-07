<?php

    $serverName = "localhost";
    $user = "root";
    $dbPass = "pass";    

    $mysqli = mysqli_connect($serverName, $user, $dbPass);
    if(!$mysqli) {
        die("Connection failed: " . mysqli_connect_error());
    }    

    $sql = "CREATE DATABASE temp_diary CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci";
    if (mysqli_query($mysqli, $sql)) {
      echo "Database created successfully";
    } else {
      echo "Error creating database: " . mysqli_error($mysqli);
    }
mysqli_close($mysqli);
