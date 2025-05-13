<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Araba Kiralama - Hoşgeldiniz</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-image: url('resimler/eniyi.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 100vh;
        }

        header {
            background-color: rgba(0, 68, 204, 0.85); /* Lacivert yarı şeffaf */
            color: #ffcc00;
            text-align: center;
            padding: 20px;
        }

        h1 {
            font-size: 2.5em;
            margin: 0;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: calc(80vh - 100px); /* Header ve footer yüksekliği kadar düştü */
            flex-direction: column;
        }

        .btn {
            background-color: #d4a017;
            color: #0a2d63 ;
            padding: 15px 30px;
            border: none;
            font-size: 1.2em;
            cursor: pointer;
            border-radius: 5px;
            text-decoration: none;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #e6b800;
        }

        footer {
            background-color: rgba(0, 68, 204, 0.85);
            color: #ffcc00;
            text-align: center;
            padding: 10px;
            position: absolute;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<body>
    <header>
        <h1>İBKA Araba Kiralama Sistemine Hoşgeldiniz!</h1>
    </header>

    <div class="container">
        <a href="index.php" class="btn">Araçları Görüntüle</a>
    </div>

    <footer>
        <p>&copy; İBKA Araba Kiralama</p>
    </footer>
</body>
</html>
