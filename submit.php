<?php

session_start();
mb_internal_encoding("UTF-8");

$serverName = "localhost";
$user = "root";
$dbPass = "pass";
$db = 'temp_diary';
$table = 'record_temp';

$mysqli = mysqli_connect($serverName, $user, $dbPass, $db);
if (!$mysqli) {
    die("Connection failed: " . mysqli_connect_error());
}

$mysqli->set_charset("utf8");

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $day = trim($_POST['day']);
    $val = trim($_POST['val']);
      

    $formSent = $mysqli->query("INSERT INTO $table (day, val) 
    VALUES ('$day', '$val')");
    

    $_SESSION['submitted'] = true;
    header('Location: index.php');
}
