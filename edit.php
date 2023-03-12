


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

// Обновляем данные в базе данных
if (isset($_POST["submit"])) {
    $id = $_POST["id"];
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $age = $_POST["age"];
    $height = $_POST["height"];
    $weight = $_POST["weight"];

    $sql = "UPDATE person SET first_name='$first_name', last_name='$last_name', age='$age', height='$height', weight='$weight' WHERE id='$id'";

    if (mysqli_query($conn, $sql)) {
        echo "<p>Данные успешно обновлены</p>";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

// Получаем данные из базы данных для редактирования
if (isset($_GET["id"])) {
    $id = $_GET["id"];

    $sql = "SELECT * FROM person WHERE id='$id'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
    } else {
        echo "Данные не найдены";
        exit();
    }
}

mysqli_close($conn);
?>

<h2>Редактировать данные</h2>
<form method="post" action="">
    <input type="hidden" name="id" value="<?php echo $row["id"]; ?>">

    <label>Имя:</label><br>
<input type="text" name="first_name" value="<?php echo $row["first_name"]; ?>"><br>

<label>Фамилия:</label><br>
<input type="text" name="last_name" value="<?php echo $row["last_name"]; ?>"><br>

<label>Возраст:</label><br>
<input type="text" name="age" value="<?php echo $row["age"]; ?>"><br>

<label>Рост:</label><br>
<input type="text" name="height" value="<?php echo $row["height"]; ?>"><br>

<label>Вес:</label><br>
<input type="text" name="weight" value="<?php echo $row["weight"]; ?>"><br>

<input type="submit" name="submit" value="Сохранить">

</form>

<button onclick="location.href='index.php'">Назад</button>