<?php
session_start();
require_once 'connect.php';

$login = $_POST['login'];
$email = $_POST['email'];
$password = $_POST['password'];
$password_confirm = $_POST['password_confirm'];

if (empty($login) || empty($email) || empty($password) || empty($password_confirm)) {
    $_SESSION['message'] = 'Все поля должны быть заполнены';
    header('Location: ../registration.php');
    exit();
}

$query = mysqli_query($connect, "SELECT * FROM users WHERE login = '$login'");
if (mysqli_num_rows($query) > 0) {
    $_SESSION['message'] = 'Такой логин уже существует';
    header('Location: ../registration.php');
    exit();
}

if (!preg_match("/^[a-zA-Z0-9!@#$%^&*()_+-]+$/", $password)) {
    $_SESSION['message'] = 'Пароль содержит недопустимые символы';
    header('Location: ../registration.php');
    exit();
}

if (strlen($password) < 5 || strlen($password) > 8) {
    $_SESSION['message'] = 'Пароль должен содержать от 5 до 8 символов';
    header('Location: ../registration.php');
    exit();
}

if (!preg_match("/^[a-zA-Zа-яА-Я0-9_]+$/u", $login)) {
    $_SESSION['message'] = 'Логин содержит недопустимые символы';
    header('Location: ../registration.php');
    exit();
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $_SESSION['message'] = 'Некорректный адрес электронной почты';
    header('Location: ../registration.php');
    exit();
}

list($username, $domain) = explode('@', $email);
if (!checkdnsrr($domain, 'MX')) {
    $_SESSION['message'] = 'Домен электронной почты не существует';
    header('Location: ../registration.php');
    exit();
}

if ($password == $password_confirm) {
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    mysqli_query($connect, "INSERT INTO users (`id`,`login`, email, password, `avatar`) VALUES (NULL, '$login', '$email', '$hashed_password', '');");
    $user_id = mysqli_insert_id($connect); // создание айди пользователя

    // прописывание игрока в таблице его показателей энергии и хп
    mysqli_query($connect, "INSERT INTO user_stats (`user_id`, `health`, `energy`) VALUES ('$user_id', 100, 100);");
    $_SESSION['message'] = 'Регистрация прошла успешно';
    header('Location: ../smradovo.php');
    exit();
} else {
    $_SESSION['message'] = 'Пароли не совпадают';
    header('Location: ../registration.php');
    exit();
}
