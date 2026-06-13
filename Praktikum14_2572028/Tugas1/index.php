<?php
// 2572028 -Nathanael Wijaya
include_once "koneksi.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        table,
        tr,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
            margin: 3px;
            padding: 3px;
        }
    </style>
</head>

<body>
    <h1>Form Input data :</h1>
    <?php echo "<h1>", "Nathanael Wijaya/2572028", "</h1>"; ?>

    <fieldset>
        <legend>Isian data</legend>
        <form action="proccess.php" method="POST">
            <input type="text" name="name" placeholder="Your name" required>
            <input type="email" name="email" placeholder="Your gmail" required>
            <input type="submit" name="btnsub" value="saved">
        </form>
    </fieldset>
    <br>
    <?php $keyword = isset($_GET['keyword']) ? trim($_GET['keyword']) : ''; ?>
    <form action="index.php" method="get">
        <input type="text" name="keyword" value="<?= htmlspecialchars($keyword) ?>">
        <input type="submit" name="find" value="find">
    </form>
    <?php
    $msg = isset($_GET['msg']) ? trim($_GET['msg']) : "";
    echo "<span style='color: red;'>" . $msg . "</span>";


    if ($keyword != '') {
        $sql = "SELECT user_id, first_name, email FROM pengguna WHERE first_name LIKE :keyword OR email LIKE :keyword";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':keyword', "%$keyword%", PDO::PARAM_STR);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            echo "<table><tr><th>ID</th><th>Firstname</th><th>Email</th></tr>";
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>";
                echo "<td>" . $row['user_id'] . "</td>";
                echo "<td>" . $row['first_name'] . "</td>";
                echo "<td>" . $row['email'] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
            unset($stmt);
        } else {
            echo "No records found.";
        }
    } else {
        $sql = "SELECT user_id, first_name, email FROM pengguna";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            echo "<table><tr><th>ID</th><th>Firstname</th><th>Email</th></tr>";
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>";
                echo "<td>" . $row['user_id'] . "</td>";
                echo "<td>" . $row['first_name'] . "</td>";
                echo "<td>" . $row['email'] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
            unset($result);
        } else {
            echo "No records found.";
        }
    }
    $conn = null;

    ?>
</body>

</html>