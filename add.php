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

// Добавляем данные в базу данных
if (isset($_POST["submit"])) {
$first_name = $_POST["first_name"];
$last_name = $_POST["last_name"];
$age = $_POST["age"];
$height = $_POST["height"];
$weight = $_POST["weight"];

$sql = "INSERT INTO person (first_name, last_name, age, height, weight) VALUES ('$first_name', '$last_name', '$age', '$height', '$weight')";

if (mysqli_query($conn, $sql)) {
    echo "<p>Данные успешно добавлены</p>";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
}

mysqli_close($conn);
?>
<h2>Добавить данные</h2>
<form method="post" action="">
    <label>Имя:</label><br>
    <input type="text" name="first_name"><br>
    <label>Фамилия:</label><br>

<input type="text" name="last_name"><br>

<label>Возраст:</label><br>
<input type="text" name="age"><br>

<label>Рост:</label><br>
<input type="text" name="height"><br>

<label>Вес:</label><br>
<input type="text" name="weight"><br>

<input type="submit" name="submit" value="Добавить">

</form>

<button onclick="location.href='index.php'">Назад</button>