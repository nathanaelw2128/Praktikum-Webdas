<?php
// 2572028 - Nathanael Wijaya
$servername = "localhost";
$db_user = "root";
$db_pass = "";
$dbname = "db_webdasar";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $db_user, $db_pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>