<?php


$host = "atlas.dsv.su.se";
$database = "db_21370799";
$username = "usr_21370799";
$password = "370799";
$port = "3306";

$conn = new mysqli($host, $username, $password, $database, $port);

$sql = "ALTER TABLE product
        ADD COLUMN rea INT NOT NULL DEFAULT 0";

// Execute the query
$result = $conn->query($sql);

// Check if the query was successful
if ($result === TRUE) {
    echo "Success";
} else {
    echo "Error" . $conn->error;
}


$conn->close();

?>