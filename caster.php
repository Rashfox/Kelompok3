<?php
session_start();
require_once 'function.php'; // Memanggil file function.php

// Inisialisasi list caster jika belum ada
if (!isset($_SESSION['caster_list'])) {
    $_SESSION['caster_list'] = serialize(new CasterCircularList());
}

$casterList = unserialize($_SESSION['caster_list']);

// Proses aksi dari form yang dikirim melalui method post
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'];

    if ($action === 'add') {
        // Aksi menambahkan caster dengan mengambil inputan dari form
        $nama = $_POST['nama']; 
        $kontak = $_POST['kontak'];
        $casterList->add(['nama' => $nama, 'kontak' => $kontak]); // tambahkan data ke dalam list
    } elseif ($action === 'rotate') {
        // Aksi memutar urutan caster
        $casterList->rotate();
    } elseif ($action === 'delete') {
        // Aksi menghapus caster
        $nama = $_POST['nama'];
        $kontak = $_POST['kontak'];

        $casters = $casterList->display();
        foreach ($casters as $c) {
            if ($c['nama'] === $nama && $c['kontak'] === $kontak) {
                $casterList->remove($c);
                break;
            }
        }
    }

    // Simpan kembali ke session
    $_SESSION['caster_list'] = serialize($casterList);

    // Hindari resubmission saat refresh
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
        <h2>Manajemen Caster</h2>
        <!-- Form tambah caster -->
        <form action="caster.php" method="post">
            <input type="hidden" name="action" value="add">
            <label for="nama">Nama Caster:</label><br>
            <input type="text" id="nama" name="nama" placeholder="Nama Caster" required><br><br>
            <label for="kontak">Kontak Caster:</label><br>
            <input type="text" id="kontak" name="kontak" placeholder="Kontak Caster" required><br><br>
            <button type="submit">Tambah Caster</button>
        </form>

        <h3>Daftar Caster</h3>
        <ul class="dft_caster_panitia">
            <?php
            $casters = $casterList->display();
            if (empty($casters)) {
                echo "<li>Belum ada caster yang ditambahkan.</li>";
            } else {
                foreach ($casters as $c) {
                    echo "<li>
                            <div class='data_caster_panitia'>Nama: " . htmlspecialchars($c['nama']) . " | Kontak: " . htmlspecialchars($c['kontak'])."
                            <form action='caster.php' method='post' style='display:inline'>
                                <input type='hidden' name='action' value='delete'>
                                <input type='hidden' name='nama' value='" . htmlspecialchars($c['nama']) . "'>
                                <input type='hidden' name='kontak' value='" . htmlspecialchars($c['kontak']) . "'>
                            <button type='submit' class='btn-delete'>Hapus</button>
                        </form></div>
                    </li>";
                }
            }
            ?>
        </ul>

        <!-- Tombol untuk memutar urutan caster -->
        <form action="caster.php" method="post" style="margin-top: 20px;">
            <input type="hidden" name="action" value="rotate">
            <button type="submit">Putar Caster</button>
        </form>
        
        <!-- Menampilkan caster saat ini -->
        <h3>Caster Saat Ini:</h3>
        <p>
            <?php
            $current = $casterList->current();
            echo $current
                ? "Nama: " . htmlspecialchars($current['nama']) . " | Kontak: " . htmlspecialchars($current['kontak'])
                : "Tidak ada caster.";
            ?>
        </p>
    </main>

    <footer>
        <p>&copy; 2025 ETournament | Kelompok 3 - All Right Reserved.</p>
    </footer>

</body>
</html>
