<?php
include('db.php');

// Kampanyaları veritabanından al
$sql = "SELECT * FROM kampanyalar ORDER BY baslangic_tarihi DESC";
$stmt = $conn->prepare($sql);
$stmt->execute();
$kampanyalar = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Kampanyalar</title>
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
            font-size: 2.5em;
        }

        .kampanya-karti {
            width: 90%;
            max-width: 800px;
            margin: 30px auto;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            padding: 20px;
        }

        .kampanya-karti h2 {
            color: #0044cc;
            margin-top: 0;
        }

        .kampanya-karti p {
            margin: 10px 0;
        }

        .tarih {
            color: #888;
            font-size: 0.9em;
        }

        .back-btn {
            display: block;
            width: 200px;
            margin: 20px auto;
            padding: 10px;
            text-align: center;
            background-color: #ffcc00;
            color: #0044cc;
            text-decoration: none;
            font-size: 1.2em;
            border-radius: 5px;
        }

        .back-btn:hover {
            background-color: #e6b800;
        }

        footer {
            background-color: #0044cc;
            color: #ffcc00;
            text-align: center;
            padding: 10px;
        }
    </style>
</head>
<body>
    <header>
        <h1>Kampanyalar</h1>
    </header>

    <?php if (count($kampanyalar) > 0): ?>
        <?php foreach ($kampanyalar as $kampanya): ?>
            <div class="kampanya-karti">
                <h2><?php echo htmlspecialchars($kampanya['baslik']); ?></h2>
                <p><?php echo nl2br(htmlspecialchars($kampanya['aciklama'])); ?></p>
                <p class="tarih">
                    <?php if ($kampanya['baslangic_tarihi']): ?>
                        Başlangıç: <?php echo $kampanya['baslangic_tarihi']; ?> |
                    <?php endif; ?>
                    <?php if ($kampanya['bitis_tarihi']): ?>
                        Bitiş: <?php echo $kampanya['bitis_tarihi']; ?>
                    <?php endif; ?>
                </p>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p style="text-align:center; margin-top:40px;">Şu anda aktif kampanya bulunmamaktadır.</p>
    <?php endif; ?>

    <a href="index.php" class="back-btn">← Geri Dön</a>

    <footer>
        <p>&copy; İBKA Araba Kiralama</p>
    </footer>
</body>
</html>
