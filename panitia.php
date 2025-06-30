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
            <li><a href="panitia.php" class="menu">Panitia</a></li>
            <li><a href="about.php" class="menu">About</a></li>
        </ul>
    </nav>
    <main>
        <h2>Manajemen Panitia</h2>
        <form method="POST" action="panitia.php">
            <label>Nama Panitia:</label>
            <input type="text" name="nama" placeholder="Nama Panitia" required>
            <label>Kontak Panitia:</label>
            <input type="text" name="kontak" placeholder="Kontak Panitia" required>
            <button type="submit" name="action" value="add">Tambah Panitia</button>
        </form>
    </main>
    <section>
    </section>
    <footer>
        <p>&copy; 2025 ETournament. All Right Reserved.</p>
    </footer>
</body>
</html>