<?php
include 'db.php';
$message = "";

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $login = $_POST['login'];
    $age = $_POST['age'];
    $password = $_POST['password'];

    if($age<21) {
        $message = "Вы не прошли по возрасту";
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (login, age, password)
                VALUES ('$login', '$age', '$hashed_password')"; 
        if($conn->query($sql) === TRUE) {
            $message = "Поздравляем, вы подходите по возрасту";
        } else {
            $message = "Ошибка: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Регистрация</title>
    <link rel="stylesheet" href ="style.css">
</head>
<body>

<h2>Регистрация</h2>

<form method="POST">
    <input type="text" name="login" placeholder="Логин" required><br>
    <input type="number" name="age" placeholder="Возраст" required><br>
    <input type="password" name="password" placeholder="Пароль" required><br>
    <button type="submit">Зарегестрироваться</button>
</form>

<p><?php echo $message; ?></p>

<h3>Список пользователей</h3>

<?php
$result = $conn->query("SELECT login, age FROM users");

if($result->num_rows > 0) {
    while($row=$result->fetch_assoc()){
        echo "Логин: " . $row['login'] . " | Возраст: " . $row['age'] . "<br>";
    }
} else { 
    echo "Пока нет пользователей"; }
?>

</body>
</html>