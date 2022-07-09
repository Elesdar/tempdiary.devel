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

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $date1 = trim($_POST['date1']);
    $date2 = trim($_POST['date2']);
    $time = trim($_POST['time']);
    
    if ((isset($date1) && isset($date2)) && (isset($time) == false)){
        $data = $mysqli->query("SELECT val FROM $table where day >= $date1 AND day <= $date2");
    } elseif ($time == 'all'){
        $data = $mysqli->query("SELECT val FROM $table");
    } elseif ($time == 'week') {
        $data = $mysqli->query("SELECT val FROM $table ORDER BY day DESC LIMIT 7");
    } elseif ($time == 'month') {
        $data = $mysqli->query("SELECT val FROM $table ORDER BY day DESC LIMIT 30");
    }     
    
    function averageValue($mysqli, $table, $data){    
        $array = [];
        while($result = mysqli_fetch_array($data, MYSQLI_ASSOC)) {
            $array[] = $result;
        }
        $count = count($array);
        $sum = 0;        
        foreach ($array as $record) { 
            $record = $record['val']; 
            $sum = $sum + $record;        
        }
        $average = $sum / $count;
        return $average;
    }    
    $av = averageValue($mysqli, $table, $data);

    $_SESSION['submitted'] = true;
    header('Location: index.php');
}
