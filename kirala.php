<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('db.php');

// Veriyi al
$sql = "SELECT bilgi FROM kiralama_bilgileri ORDER BY id DESC LIMIT 1";
$stmt = $conn->prepare($sql);
$stmt->execute();
$kiralamaBilgi = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Kiralama Bilgileri</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #0044cc;
            color: #ffcc00;
            text-align: center;
            padding: 20px;
        }

        h1 {
            margin: 0;
            font-size: 2em;
        }

        .icerik {
            max-width: 600px;
            background-color: #fff;
            margin: 40px auto;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            text-align: center;
        }

        .bilgi-text {
            font-size: 1.1em;
            color: #333;
            line-height: 1.6;
        }

        .geri-btn {
            display: inline-block;
            margin-top: 20px;
            background-color: #ffcc00;
            color: #0044cc;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
        }

        .geri-btn:hover {
            background-color: #e6b800;
        }

        footer {
            background-color: #0044cc;
            color: #ffcc00;
            text-align: center;
            padding: 10px;
            margin-top: 60px;
        }
    </style>
</head>
<body>
    <header>
        <h1>Araç Kiralama Bilgileri</h1>
    </header>

    <div class="icerik">
        <?php if ($kiralamaBilgi): ?>
            <p class="bilgi-text"><?php echo nl2br(htmlspecialchars($kiralamaBilgi['bilgi'])); ?></p>
        <?php else: ?>
            <p class="bilgi-text">Henüz kiralama bilgisi eklenmemiş.</p>
        <?php endif; ?>

        <a href="index.php" class="geri-btn">← Geri Dön</a>
    </div>

    <footer>
        <p>&copy; İBKA Araba Kiralama</p>
    </footer>
</body>
</html>
