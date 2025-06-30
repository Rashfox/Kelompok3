<?php
session_start();
require_once 'function.php'; // Mengimpor class dari function.php

// Inisialisasi objek jika belum ada di session
if (!isset($_SESSION['caster_list'])) {
    $_SESSION['caster_list'] = serialize(new CasterCircularList());
}

// Ambil dari session dan unserialize
$casterList = unserialize($_SESSION['caster_list']);

// Tangani form add
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'];

    if ($action === 'add') {
        $nama = $_POST['nama'];
        $kontak = $_POST['kontak'];
        $casterList->add(['nama' => $nama, 'kontak' => $kontak]);
    } elseif ($action === 'rotate') {
        $casterList->rotate();
    }

    // Simpan kembali ke session
    $_SESSION['caster_list'] = serialize($casterList);

    // Hindari form resubmission saat refresh
    header("Location: caster.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>ETournament</title>
</head>
<body>
    <header>
        <h1>ETournament</h1>
    </header>
    <nav>
        <ul class="nav">
            <li><a href="index.php" class="menu">Home</a></li>
            <li><a href="caster.php" class="menu">Caster</a></li>
            <li><a href="" class="menu">Panitia</a></li>
            <li><a href="" class="menu">Show</a></li>
            <li><a href="" class="menu">About</a></li>
        </ul>
    </nav>
    <main>
        <h2>Manajemen Caster</h2>
        <form action="caster.php" method="post">
            <input type="hidden" name="action" value="add">
            <label for="nama">Nama Caster:</label>
            <input type="text" id="nama" name="nama" required>
            <label for="kontak">Kontak:</label>
            <input type="text" id="kontak" name="kontak" required>
            <button type="submit">Tambah Caster</button>
        </form>

        <h3>Daftar Caster</h3>
        <ul>
            <?php
            $casters = $casterList->display();
            if (empty($casters)) {
                echo "<li>Belum ada caster ditambahkan.</li>";
            } else {
                foreach ($casters as $c) {
                    echo "<li>Nama: " . htmlspecialchars($c['nama']) . " | Kontak: " . htmlspecialchars($c['kontak']) . "</li>";
                }
            }
            ?>
        </ul>

        <form action="caster.php" method="post" style="margin-top: 20px;">
            <input type="hidden" name="action" value="rotate">
            <button type="submit">Putar Caster</button>
        </form>

        <h3>Caster Saat Ini:</h3>
        <p>
            <?php
            $current = $casterList->current();
            echo $current ? "Nama: " . htmlspecialchars($current['nama']) . " | Kontak: " . htmlspecialchars($current['kontak']) : "Tidak ada caster.";
            ?>
        </p>
    </main>
    <footer>
        <p>&copy; 2025 ETournament. All Right Reserved.</p>
    </footer>
</body>
</html>
