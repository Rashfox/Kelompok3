<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ETournament</title>
</head>
<body>
     <header>
        <h1>ETournament</h1>
    </header>
    <nav>
        <ul class="nav">
            <li><a href="index.php" class="menu">Home</a></li>
            <li><a href="" class="menu">Caster</a></li>
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
    </main>
    <section>

    </section>
    <footer>
        <p>&copy; 2025 ETournament. All Right Reserved.</p>
    </footer>
</body>
</html>