<?php
include('db.php');

// Arabaları veritabanından al
$sql = "SELECT * FROM arabalar";
$stmt = $conn->prepare($sql);
$stmt->execute();
$arabalar = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Araçlar</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            transition: background-color 0.3s, color 0.3s;
        }

        /* Gece Modu */
        .gece-modu {
            background-color: #333;
            color: #f4f4f9;
        }

        /* Gündüz Modu */
        .gunduz-modu {
            background-color: #f4f4f9;
            color: #333;
        }

        header {
            background-color: #0044cc;
            color: #ffcc00;
            text-align: center;
            padding: 20px;
            position: relative;
        }

        h1 {
            font-size: 2.5em;
            margin: 0;
        }

        .logout-btn,
        .kampanya-btn {
            position: absolute;
            top: 20px;
            background-color: #ffcc00;
            color: #0044cc;
            padding: 10px 15px;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s ease;
        }

        .logout-btn {
            right: 30px;
        }

        .kampanya-btn {
            right: 150px;
        }

        .logout-btn:hover,
        .kampanya-btn:hover {
            background-color: #e6b800;
        }

        /* Buton stili */
        .mode-btn {
            position: absolute;
            top: 20px;
            left: 20px;
            background-color: #ffcc00;
            color: #0044cc;
            padding: 10px;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            cursor: pointer;
        }

        table {
            width: 95%;
            margin: 50px auto;
            border-collapse: collapse;
        }

        th, td {
            padding: 10px;
            text-align: center;
            border: 1px solid #ddd;
        }

        th {
            background-color: #0044cc;
            color: #ffcc00;
        }

        td {
            background-color: #fff;
        }

        img.araba-resim {
            max-width: 120px;
            max-height: 80px;
            border-radius: 8px;
            object-fit: cover;
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
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s ease;
        }

        .back-btn:hover {
            background-color: #e6b800;
        }

        .detay-link,
        .kirala-link {
            background-color: #0044cc;
            color: #fff;
            padding: 5px 10px;
            text-decoration: none;
            border-radius: 4px;
            font-size: 0.9em;
            margin: 2px;
            display: inline-block;
        }

        .kirala-link {
            background-color: #28a745;
        }

        .detay-link:hover {
            background-color: #003399;
        }

        .kirala-link:hover {
            background-color: #218838;
        }

        footer {
            background-color: #0044cc;
            color: #ffcc00;
            text-align: center;
            padding: 10px;
        }
    </style>
</head>
<body class="gunduz-modu">
    <header>
        <h1>Mevcut Araçlar</h1>
        <a href="kampanyalar.php" class="kampanya-btn">Kampanyalar</a>
        <a href="cikis.php" class="logout-btn">Çıkış Yap</a>
        <button id="modeToggle" class="mode-btn">Gece Modu</button>
    </header>

    <table>
        <tr>
            <th>Görsel</th>
            <th>Marka</th>
            <th>Model</th>
            <th>Fiyat (Günlük)</th>
            <th>Durum</th>
            <th>İşlemler</th>
        </tr>
        <?php foreach ($arabalar as $araba): ?>
        <tr>
            <td>
                <?php
                    $resim = !empty($araba['resim']) ? $araba['resim'] : 'default.jpg';
                ?>
                <a href="resimler/<?php echo $resim; ?>" target="_blank">
                    <img src="resimler/<?php echo $resim; ?>" class="araba-resim" alt="Araç Görseli">
                </a>
            </td>
            <td><?php echo htmlspecialchars($araba['marka']); ?></td>
            <td><?php echo htmlspecialchars($araba['model']); ?></td>
            <td><?php echo $araba['fiyat_gunluk']; ?> ₺</td>
            <td><?php echo htmlspecialchars($araba['durum']); ?></td>
            <td>
                <a href="detay.php?id=<?php echo $araba['id']; ?>" class="detay-link">Detay</a>
                <a href="kirala.php?id=<?php echo $araba['id']; ?>" class="kirala-link">Kirala</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>

    <a href="giris.php" class="back-btn">Geri Dön</a>

    <footer>
        <p>&copy; İBKA Araba Kiralama</p>
    </footer>

    <script>
        const modeToggle = document.getElementById('modeToggle');
        const body = document.body;

        modeToggle.addEventListener('click', () => {
            if (body.classList.contains('gunduz-modu')) {
                body.classList.remove('gunduz-modu');
                body.classList.add('gece-modu');
                modeToggle.textContent = 'Gündüz Modu';
            } else {
                body.classList.remove('gece-modu');
                body.classList.add('gunduz-modu');
                modeToggle.textContent = 'Gece Modu';
            }
        });
    </script>
</body>
</html>
