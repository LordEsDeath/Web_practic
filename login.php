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

// Проверяем, была ли отправлена форма
if (isset($_POST["submit"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        $_SESSION["username"] = $row["username"];

        if ($row["username"] == "admin") {
            $_SESSION["is_admin"] = true;
        }

        header("Location: index.php");
        exit();
    } else {
        echo "<p>Неверное имя пользователя или пароль</p>";
}
}

mysqli_close($conn);
?>
<h2>Вход</h2>
<form method="post" action="">
    <label>Имя пользователя:</label><br>
    <input type="text" name="username"><br>
    <label>Пароль:</label><br>
    <input type="password" name="password"><br>

    <input type="submit" name="submit" value="Войти">
    </form>

    <button onclick="location.href='index.php'">Назад</button>