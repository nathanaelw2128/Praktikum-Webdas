<?php
// 2572028 - Nathanael Wijaya
include_once "koneksi.php";

$message = isset($_GET["msg"]) ? $_GET["msg"] : "";
$messageType = isset($_GET["type"]) ? $_GET["type"] : "";

$stmt = $conn->prepare("SELECT * FROM buku_tamu ORDER BY waktu DESC");
$stmt->execute();
$totalKomentar = $stmt->rowCount();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BukuTamu – 2572028</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body class="bg-light py-4">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-7">
                <div class="card">
                    <div class="card-body">

                        <h5 class="fw-bold mb-3">Buku Tamu</h5>

                        <?php if ($message != ""): ?>
                            <div class="alert alert-<?= $messageType ?>"><?= htmlspecialchars($message) ?></div>
                        <?php endif; ?>

                        <form method="POST" action="proses.php">
                            <div class="mb-3">
                                <label class="form-label">Nama</label>
                                <input name="nama" type="text" class="form-control" placeholder="Nama lengkap kamu">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Asal Kota</label>
                                <input name="asal" type="text" class="form-control" placeholder="Contoh: Bandung">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Komentar</label>
                                <textarea name="komentar" class="form-control" rows="3"
                                    placeholder="Tulis komentar atau kesanmu..."></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Kirim Komentar</button>
                        </form>

                        <hr class="my-4">

                        <h6 class="fw-bold">Komentar Tamu (<?= $totalKomentar ?> komentar)</h6>

                        <?php if ($totalKomentar == 0): ?>
                            <p class="text-muted">Belum ada komentar</p>
                        <?php else: ?>
                            <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
                                <div class="border-bottom py-2">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <strong><?= htmlspecialchars($row['nama']) ?></strong>
                                        <span class="text-muted small">
                                            <?= htmlspecialchars($row['asal']) ?> | <?= htmlspecialchars($row['waktu']) ?>
                                        </span>
                                    </div>
                                    <p class="fst-italic mb-0 mt-1">"<?= htmlspecialchars($row['komentar']) ?>"</p>
                                </div>
                            <?php endwhile; ?>
                        <?php endif; ?>

                    </div>
                </div>
                <p class="text-center text-muted small mt-2">2572028 - Nathanael Wijaya</p>
            </div>
        </div>
    </div>
</body>

</html>