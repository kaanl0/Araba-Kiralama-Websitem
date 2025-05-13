<?php
include('db.php');

// URL'den id'yi al
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // ID'ye göre araba verisini çek
    $sql = "SELECT * FROM arabalar WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $araba = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$araba) {
        echo "Araç bulunamadı.";
        exit;
    }
} else {
    echo "Geçersiz istek.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title><?php echo $araba['marka'] . ' ' . $araba['model']; ?> - Detay</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            text-align: center;
            padding: 40px;
        }

        .arac-detay {
            display: inline-block;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 20px;
            max-width: 500px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        img {
            width: 100%;
            height: auto;
            border-radius: 10px;
        }

        h2 {
            color: #0044cc;
        }

        .geri {
            margin-top: 20px;
            display: inline-block;
            background-color: #ffcc00;
            color: #0044cc;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
        }

        .geri:hover {
            background-color: #e6b800;
        }

        .ozellikler {
            margin-top: 15px;
            font-size: 16px;
            color: #333;
        }
    </style>
</head>
<body>
    <div class="arac-detay">
        <img src="resimler/<?php echo $araba['resim']; ?>" alt="Araç Görseli" style="max-width:300px;">
        <h2><?php echo $araba['marka'] . ' ' . $araba['model']; ?></h2>
        <p><strong>Fiyat (Günlük):</strong> <?php echo $araba['fiyat_gunluk']; ?> ₺</p>
        <p><strong>Durum:</strong> <?php echo $araba['durum']; ?></p>
        <?php if (!empty($araba['ozellikler'])): ?>
            <p class="ozellikler"><strong>Özellikler:</strong> <?php echo htmlspecialchars($araba['ozellikler']); ?></p>
        <?php endif; ?>
    </div>

    <a href="index.php" class="geri">← Geri Dön</a>
</body>
</html>
