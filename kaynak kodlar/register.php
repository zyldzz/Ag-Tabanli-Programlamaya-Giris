<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "uyeol"; 

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $kullaniciAdi = $_POST['username'];
        $eposta = $_POST['email'];
        $sifre = $_POST['password'];

        $hashedPassword = password_hash($sifre, PASSWORD_BCRYPT);

        $stmt = $conn->prepare("INSERT INTO users (kullanici_adi, eposta, password) VALUES (:kullaniciAdi, :eposta, :hashedPassword)");
        $stmt->bindParam(':kullaniciAdi', $kullaniciAdi);
        $stmt->bindParam(':eposta', $eposta);
        $stmt->bindParam(':hashedPassword', $hashedPassword);

        $stmt->execute();
        echo "Kayıt başarılı!";
    }
} catch (PDOException $e) {
    echo "Hata: " . $e->getMessage();
}
?>