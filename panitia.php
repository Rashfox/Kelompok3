<?php
session_start();
require_once 'function.php'; // Memanggil file function.php

// Inisialisasi list panitia jika belum ada
if (!isset($_SESSION['panitia_list'])) {
    $_SESSION['panitia_list'] = serialize(new PanitiaCircularList());
}

$panitiaList = unserialize($_SESSION['panitia_list']);

// Proses aksi dari form yang dikirim melalui method post
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'];

    if ($action === 'add') {
        // Aksi menambahkan panitia dengan mengambil inputan dari form
        $nama = $_POST['nama'];
        $kontak = $_POST['kontak'];
        $panitiaList->add(['nama' => $nama, 'kontak' => $kontak]);
    } elseif ($action === 'delete') {
        // Aksi menghapus panitia
        $nama = $_POST['nama'];
        $kontak = $_POST['kontak'];

        $daftar = $panitiaList->display();
        foreach ($daftar as $p) {
            if ($p['nama'] === $nama && $p['kontak'] === $kontak) {
                $panitiaList->remove($p);
                break;
            }
        }
    } elseif ($action === 'rotate') {
        // Aksi untuk merotasi panitia
        $panitiaList->rotate();
    }

    // Simpan kembali ke session
    $_SESSION['panitia_list'] = serialize($panitiaList);
    header("Location: panitia.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ETournament</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <header>
        <h1>ETournament</h1>
    </header>

    <!-- Navigasi menu -->
    <nav>
        <ul class="nav">
            <li><a href="index.php" class="menu">Home</a></li>
            <li><a href="caster.php" class="menu">Caster</a></li>
            <li><a href="panitia.php" class="menu">Panitia</a></li>
            <li><a href="about.php" class="menu">About</a></li>
        </ul>
    </nav>

    <main class="caster_panitia">
        <h2>Manajemen Panitia</h2>
        <!-- Form tambah panitia -->
        <form method="POST" action="panitia.php">
            <label>Nama Panitia:</label><br>
            <input type="text" name="nama" placeholder="Nama Panitia" required><br><br>
            <label>Kontak Panitia:</label><br>
            <input type="text" name="kontak" placeholder="Kontak Panitia" required><br><br>
            <button type="submit" name="action" value="add">Tambah Panitia</button>
        </form>

        <h3>Daftar Panitia</h3>
        <ul class="dft_caster_panitia">
            <?php
            $daftar = $panitiaList->display();
            if (empty($daftar)) {
                echo "<li>Belum ada panitia yang ditambahkan.</li>";
            } else {
                foreach ($daftar as $p) {
                    echo "<li>
                        <div class='data_caster_panitia'>Nama: " . htmlspecialchars($p['nama']) . " | Kontak: " . htmlspecialchars($p['kontak']);
                    echo " 
                        <form action='panitia.php' method='post' style='display:inline'>
                            <input type='hidden' name='action' value='delete'>
                            <input type='hidden' name='nama' value='" . htmlspecialchars($p['nama']) . "'>
                            <input type='hidden' name='kontak' value='" . htmlspecialchars($p['kontak']) . "'>
                            <button type='submit' class='btn-delete'>Hapus</button>
                        </form></div>
                    </li>";
                }
            }
            ?>
        </ul>

        <!-- Tombol untuk merotasi urutan panitia -->
        <form method="POST" action="panitia.php" style="margin-top: 1rem;">
            <button type="submit" name="action" value="rotate">Auto Rotate Panitia</button>
        </form>

        <!-- Menampilkan panitia saat ini -->
        <h3>Panitia Saat Ini:</h3>
        <p>
            <?php
            $current = $panitiaList->current();
            echo $current
                ? "Nama: " . htmlspecialchars($current['nama']) . " | Kontak: " . htmlspecialchars($current['kontak'])
                : "Tidak ada panitia.";
            ?>
        </p>
    </main>

    <footer>
        <p>&copy; 2025 ETournament | Kelompok 3 - All Right Reserved.</p>
    </footer>

</body>
</html>
