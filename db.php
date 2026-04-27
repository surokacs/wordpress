<?php
$host = "localhost";
$user = "root";
$password = "";
$dbname = "register_api1";

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Ошибка подключения: ". $conn->connect_erorr);
}
?>