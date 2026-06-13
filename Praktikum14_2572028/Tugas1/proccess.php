<?php
// 2572028 -Nathanael Wijaya
include_once "koneksi.php";

$firstname = FILTER_INPUT(INPUT_POST, 'name');
$email = FILTER_INPUT(INPUT_POST, 'email');
$sub = FILTER_INPUT(INPUT_POST, 'btnsub');
if ($sub) {
    try {
        $sql = "INSERT INTO pengguna (first_name, email) VALUES (:fname, :email)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            'fname' => $firstname,
            'email' => $email
        ]);
        //$msg = "New record created successfully";
    } catch (PDOException $e) {
        $msg = $sql . "<br>" . $e->getMessage();
    }
    $conn = null;
    header("location:index.php?msg=" . $msg);
}
exit;
?>