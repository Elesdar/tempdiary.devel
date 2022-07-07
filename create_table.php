
<?php
//Connection with DB

$link = mysqli_connect("127.0.0.1", "root", "pass");

if ($link === false) {
    die("ERROR: Could not connect. ". mysqli_connect_error());
}

$selectDB = "USE temp_diary";
if (mysqli_query($link, $selectDB)) {
    echo "Database selected successfully. ";
} else {
    echo "ERROR: Could not able to execute $selectDB. " . mysqli_error($link);
}

// Table
$sql = "CREATE TABLE record_temp(
    id INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    day DATE NOT NULL,
    val DOUBLE(10, 2) NOT NULL
   )";


//Result of creation table

if (mysqli_query($link, $sql)) {
    echo "Table created successfully. ";
} else {
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}
 
// Close connection
mysqli_close($link);
?>
