<?php
// 2572028 -Nathanael Wijaya
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tabel_webdas14";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Connected succesfully";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>