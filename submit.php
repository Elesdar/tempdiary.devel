<?php

session_start();
mb_internal_encoding("UTF-8");
require_once 'connection_db.php';

$serverName = "localhost";
$user = "root";
$dbPass = "pass";
$db = 'temp_diary';
$table = 'record_temp';

$pdo = getConnection();

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $day = trim($_POST['day']);
    $val = trim($_POST['val']);      

    $stmt = $pdo ->prepare("INSERT INTO $table (day, val) VALUES (:day, :val)");
    $stmt->execute(array('day' => $day, 'val' => $val));
    

    $_SESSION['submitted'] = true;
    header('Location: index.php');
}
