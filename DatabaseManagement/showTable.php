<?php

$host = "atlas.dsv.su.se";
$database = "db_21370799";
$username = "usr_21370799";
$password = "370799";
$port = "3306";

$conn = new mysqli($host, $username, $password, $database, $port);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}



$query = "SELECT CONSTRAINT_NAME
          FROM INFORMATION_SCHEMA.KEY_COLUMN_USAGE
          WHERE TABLE_SCHEMA = '$database'
          AND TABLE_NAME = 'cashout'
          AND REFERENCED_TABLE_NAME IS NOT NULL";

$result = $conn->query($query);

if ($result) {
    while ($row = $result->fetch_assoc()) {
        echo "Foreign Key Name: " . $row['CONSTRAINT_NAME'] . "<br>";
    }
} else {
    echo "Error: " . $conn->error;
}

$conn->close();

?>