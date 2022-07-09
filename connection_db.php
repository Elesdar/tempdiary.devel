<?php
function getConnection()
{
    $serverName = "localhost";
    $user = "root";
    $dbPass = "pass";
    $db = 'temp_diary';
    $table = 'record_temp';
    $charset = 'utf8';

    $dsn = "mysql:host=$serverName; dbname=$db; charset=$charset";
    return new PDO($dsn, $user, $dbPass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);   
}