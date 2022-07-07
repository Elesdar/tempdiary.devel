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
    $date1 = trim($_POST['date1']);
    $date2 = trim($_POST['date2']);
    $time = trim($_POST['time']);
    
    if ((isset($date1) && isset($date2)) && (isset($time) == false)){
        $data = $mysqli->query("SELECT val FROM $table where val >= $date1 AND val <= $date2");
    } elseif ($time == 'all'){
        $data = $mysqli->query("SELECT val FROM $table");
    } elseif ($time == 'week') {
        $data = $mysqli->query("SELECT val FROM $table ORDER BY DESC LIMIT 7");
    } elseif ($time == 'month') {
        $data = $mysqli->query("SELECT val FROM $table ORDER BY DESC LIMIT 30");
    }    

    $_SESSION['submitted'] = true;
    header('Location: index.php');
}
