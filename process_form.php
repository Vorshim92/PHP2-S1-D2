<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "session";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connessione fallita: " . $e->getMessage());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['title_en']) && isset($_POST['content_en'])) {
        $title_en = $_POST['title_en'];
        $content_en = $_POST['content_en'];
    }

    if (isset($_POST['title_it']) && isset($_POST['content_it'])) {
        $title_it = $_POST['title_it'];
        $content_it = $_POST['content_it'];
    }

    $query = "INSERT INTO news (title_it, content_it, title_en, content_en) VALUES (:title_it, :content_it, :title_en, :content_en)";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':title_it', $title_it);
    $stmt->bindParam(':content_it', $content_it);
    $stmt->bindParam(':title_en', $title_en);
    $stmt->bindParam(':content_en', $content_en);
    $stmt->execute();

    header("Location: index.php");
    exit();
}
