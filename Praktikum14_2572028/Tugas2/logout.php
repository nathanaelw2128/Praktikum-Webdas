<?php
// 2572028-Nathanael Wijaya
session_start();
session_destroy();
header("location: Login.php");
exit;
?>