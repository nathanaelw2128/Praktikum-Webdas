<?php
// 2572028-Nathanael Wijaya
include_once "koneksi.php";
$message = "";

session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name_email = isset($_POST["name_email"]) ? trim($_POST["name_email"]) : "";
    $password = isset($_POST["password"]) ? trim($_POST["password"]) : "";
    if (empty($name_email) || empty($password)) {
        $message = "Username/email & Password tidak boleh kosong!";
    } else {
        try {
            $sql = $conn->prepare("SELECT * FROM users WHERE email = ? OR username = ?");
            $sql->execute([$name_email, $name_email]);

            if ($sql->rowCount() == 0) {
                $message = "Username atau Email tidak ditemukan!";
            } else {
                $user = $sql->fetch();
                if (password_verify($password, $user["password"])) {
                    $_SESSION['username'] = $user['username'];
                    $_SESSION['loggedin'] = true;
                    header("location: dashboard.php");
                    exit;
                } else {
                    $message = "Password salah!";
                }
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
    <title>Login – 2572028</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js
"></script>
</head>

<body class="d-flex justify-content-center align-items-center vh-100">
    <div class="card" style="width: 18rem; ">
        <div class="card-body">
            <form method="POST" action="">
                <h2 class="text-center">Login</h2>

                <?php if ($message != ""): ?>
                    <div class="alert alert-danger"><?= $message ?></div>
                <?php endif; ?>
                <div class=" mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email / Username</label>
                    <input name="name_email" type="text" class="form-control" id="exampleInputEmail1"
                        aria-describedby="emailHelp">
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input name="password" type="password" class="form-control" id="exampleInputPassword1">
                </div>
                <div class="mb-3 form-check">
                </div>
                <button type="submit" class="btn btn-success w-100">Login</button>
                <div id="emailHelp" class="form-text">Belum punya akun? <a href="Register.php">Register</a></div>
            </form>
        </div>
    </div>
</body>

</html>