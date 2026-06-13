<?php
// 2572028 - Nathanael Wijaya
include_once "koneksi.php";

$nama = isset($_POST["nama"]) ? trim($_POST["nama"]) : "";
$asal = isset($_POST["asal"]) ? trim($_POST["asal"]) : "";
$komentar = isset($_POST["komentar"]) ? trim($_POST["komentar"]) : "";

if (empty($nama) || empty($asal) || empty($komentar)) {
    header("location: BukuTamu.php?msg=Semua+field+tidak+boleh+kosong!&type=danger");
    exit;
}

try {
    $sql = $conn->prepare("INSERT INTO buku_tamu (nama, asal, komentar) VALUES (?, ?, ?)");
    $sql->execute([$nama, $asal, $komentar]);
    header("location: BukuTamu.php?msg=Komentar+berhasil+disimpan!&type=success");
    exit;
} catch (PDOException $e) {
    header("location: BukuTamu.php?msg=" . urlencode($e->getMessage()) . "&type=danger");
    exit;
}
?>