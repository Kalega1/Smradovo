<?php 
session_start();
require_once 'connect.php';

$login = $_POST['login'];
$password = $_POST['password'];

// Проверяем, был ли отмечен чекбокс "Оставаться в сети"
$rememberMe = isset($_POST['remember']) ? true : false;

$result = mysqli_query($connect, "SELECT password FROM users WHERE login = '$login'");
$hash = mysqli_fetch_array($result)['password'];
$check_user = mysqli_query($connect, "SELECT * FROM users WHERE login = '$login'");
// Проверяем пароль
if (password_verify($password, $hash)) {
    $user = mysqli_fetch_assoc($check_user);
    $_SESSION['id'] = [
        "id" => $user['id'],
        "login" => $user['login'],
        "avatar" => $user['avatar'],
        "email" => $user['email'],
    ];
    $_SESSION['user_id'] = $userId;

    // Если отмечен чекбокс "Оставаться в сети", устанавливаем куки
    if ($rememberMe) {
        setcookie('login', $login, time() + 86400 * 30, '/');
        setcookie('password', $password, time() + 86400 * 30, '/');
    }

    header('Location: ../smradovo.php');
} else {
    $_SESSION['message'] = 'ЛОГИН ИЛИ ПАРОЛЬ НЕВЕРНЫЙ';
    header('Location: ../index.php');
    exit();
}
?>


