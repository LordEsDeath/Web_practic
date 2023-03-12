<?php
session_start();

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

// Получаем данные из базы данных
$sql = "SELECT * FROM person";

$result = mysqli_query($conn, $sql);

// Создаем таблицу для отображения данных
echo "<table>";
echo "<tr><th>Имя</th><th>Фамилия</th><th>Возраст</th><th>Рост</th><th>Вес</th></tr>";

while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>";
    echo "<td>" . $row["first_name"] . "</td>";
    echo "<td>" . $row["last_name"] . "</td>";
    echo "<td>" . $row["age"] . "</td>";
    echo "<td>" . $row["height"] . "</td>";
    echo "<td>" . $row["weight"] . "</td>";
    if (isset($_SESSION["username"])) {
        if ($_SESSION["username"] == "admin") {
        echo "<td><a href='edit.php?id=" . $row["id"] . "'>Редактировать</a> | <a href='delete.php?id=" . $row["id"] . "'>Удалить</a></td>";}}
    }
    echo "</tr>";


echo "</table>";

// Определяем, какие кнопки управления должны отображаться в зависимости от роли пользователя
if (isset($_SESSION["username"])) {
    if ($_SESSION["username"] == "admin") {
        
    echo "<button onclick=\"location.href='logout.php'\">Выход</button>";
}
} else {
    echo "<button onclick=\"location.href='login.php'\">Войти</button>";
}

mysqli_close($conn);
?>