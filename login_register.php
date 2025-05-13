<?php
session_start();
require_once "db.php";

$mesaj = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $sifre = $_POST["sifre"];

    if (isset($_POST["kayit"])) {
        $sifre_hash = password_hash($sifre, PASSWORD_DEFAULT);

        try {
            $sql = $conn->prepare("INSERT INTO kullanicilar (email, sifre) VALUES (?, ?)");
            $sql->execute([$email, $sifre_hash]);
            $mesaj = "Kayıt başarılı. Giriş yapabilirsiniz.";
        } catch (PDOException $e) {
            $mesaj = "Kayıt başarısız: " . $e->getMessage();
        }
    } elseif (isset($_POST["giris"])) {
        try {
            $sql = $conn->prepare("SELECT * FROM kullanicilar WHERE email = ?");
            $sql->execute([$email]);
            $kullanici = $sql->fetch(PDO::FETCH_ASSOC);

            if ($kullanici && password_verify($sifre, $kullanici["sifre"])) {
                $_SESSION["kullanici_adi"] = $kullanici["email"];
                header("Location: giris.php");
                exit();
            } else {
                $mesaj = "Hatalı şifre veya kullanıcı adı.";
            }
        } catch (PDOException $e) {
            $mesaj = "Giriş hatası: " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Giriş / Kayıt</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f5f5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .kutu {
            background: #ffe600;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
            width: 350px;
            text-align: center;
        }
        h2 {
            color: #001f5f;
        }
        input {
            width: 90%;
            padding: 10px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            width: 95%;
            padding: 10px;
            background-color: #001f5f;
            color: white;
            border: none;
            border-radius: 5px;
            margin-top: 10px;
            cursor: pointer;
        }
        .mesaj {
            margin-top: 10px;
            color: red;
        }
    </style>
</head>
<body>
    <div class="kutu">
        <h2>Giriş Yap</h2>
        <form method="POST">
            <input type="email" name="email" placeholder="E-Posta" required><br>
            <input type="password" name="sifre" placeholder="Şifre" required><br>
            <button type="submit" name="giris">Giriş Yap</button>
        </form>
        <hr>
        <h2>Kayıt Ol</h2>
        <form method="POST">
            <input type="email" name="email" placeholder="E-Posta" required><br>
            <input type="password" name="sifre" placeholder="Şifre" required><br>
            <button type="submit" name="kayit">Kayıt Ol</button>
        </form>
        <div class="mesaj"><?= $mesaj ?></div>
    </div>
</body>
</html>
