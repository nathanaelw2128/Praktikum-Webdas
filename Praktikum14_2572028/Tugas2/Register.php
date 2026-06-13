<?php
// 2572028-Nathanael Wijaya
include_once "koneksi.php";

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = isset($_POST["username"]) ? trim($_POST["username"]) : "";
    $password = isset($_POST["password"]) ? trim($_POST["password"]) : "";
    $email = isset($_POST["email"]) ? trim($_POST["email"]) : "";

    if (empty($username) || empty($password) || empty($email)) {
        $message = "Username, password, & email tidak boleh kosong!";
    } else {
        try {
            $sql = $conn->prepare("SELECT * FROM users WHERE email = ? OR username = ?");
            $sql->execute([$email, $username]);

            if ($sql->rowCount() > 0) {
                $message = "Username atau Email sudah terdaftar!";
            } else {
                $hashPassword = password_hash($password, PASSWORD_DEFAULT);
                $insert = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
                $insert->execute([$username, $email, $hashPassword]);
                header("location: Login.php?msg=Register berhasil!");
                exit;
            }
        } catch (PDOException $e) {
            $message = "Error: " . $e->getMessage();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register – 2572028</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body class="d-flex justify-content-center align-items-center vh-100">
    <div class="card" style="width: 18rem;">
        <div class="card-body">
            <form method="POST" action="">
                <h2 class="text-center">Register</h2>

                <?php if ($message != ""): ?>
                    <div class="alert alert-danger"><?= $message ?></div>
                <?php endif; ?>

                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input name="username" type="text" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input name="email" type="email" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input name="password" type="password" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary w-100">Register</button>
                <div class="form-text">Sudah punya akun? <a href="Login.php">Login</a></div>
            </form>
        </div>
    </div>
</body>

</html>