<?php
session_start();

// Проверяем, является ли пользователь администратором
if (!isset($_SESSION["username"]) || $_SESSION["username"] != "admin") {
    header("Location: index.php");
    exit();
}

// Подключаемся к базе данных
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "web_practic";

$conn = mysqli_connect($servername, $username, $password, $dbname);

// Проверяем соединение
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Удаляем данные из базы данных
if (isset($_GET["id"])) {
    $id = $_GET["id"];

    $sql = "DELETE FROM person WHERE id='$id'";

    if (mysqli_query($conn, $sql)) {
        echo "<p>Данные успешно удалены</p>";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>

<button onclick="location.href='index.php'">Назад</button>
