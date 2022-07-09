<?php
session_start();
mb_internal_encoding("UTF-8");

$serverName = "localhost";
$user = "root";
$dbPass = "pass";
$db = 'temp_diary';
$table = 'record_temp';

$mysqli = mysqli_connect($serverName, $user, $dbPass, $db);
if(!$mysqli) {
    die("Connection failed: " . mysqli_connect_error());
}

list($array, $htmlPages) = paginate($mysqli, $table);

require 'index.html';
exit;



function paginate($mysqli, $table){
    $mysqli->set_charset("utf8");
    $query = $mysqli->query("select count(*) as count from $table");

    $count = ($query->fetch_all(MYSQLI_ASSOC))[0]['count'];
    $limit = 5;

    $pages = ceil($count/$limit);
    $currentPage = 0;
    if (isset($_GET['page']) && (int)$_GET['page'] > 0 && (int)$_GET['page'] <= $pages) {
        $currentPage = ((int)$_GET['page'] - 1);
    }
    $offset = $currentPage * $limit;

    $records = $mysqli->query("SELECT * FROM $table LIMIT $offset, $limit");

    $array = [];
    while($result = mysqli_fetch_array($records, MYSQLI_ASSOC)) {
        $array[] = $result;
    }

    $htmlPages = '';

    for ($i = 1; $i <= $pages; $i++) {
        $htmlPages .= '<li class="page-item '.(($i === ($currentPage+1)) ? 'active' : '').' "><a class="page-link" href="index.php?page='.$i.'">'.$i.'</a></li>';
    }


    return [$array, $htmlPages];
}
