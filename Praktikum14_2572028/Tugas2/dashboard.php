<?php
session_start();
// 2572028-Nathanael Wijaya
$username = $_SESSION["username"];
if (!isset($_SESSION["loggedin"])) {
    header("location: Login.php");
    exit();
} else {
    $username = $_SESSION['username'];
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard-2572028</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body class="d-flex justify-content-center align-items-center vh-100">
    <div class="card" style="width: 18rem;">
        <div class="card-body">
            <h2 class="text-center">Dashboard</h2>

            <?php if ($username != ""): ?>
                <div class="alert alert-success">
                    <p>Selamat datang, <strong><?= $username ?></strong></p>
                </div>
            <?php endif; ?>
            <a href="logout.php" class="btn btn-danger ">Logout</a>
        </div>
    </div>
</body>

</html>