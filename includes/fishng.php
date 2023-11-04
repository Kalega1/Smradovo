<?php
session_start();
require_once 'connect.php';

$user_id = $_SESSION['id']['id'];

if (isset($_POST['catch_fish'])) {
    $item_id = 6; 
    $quantity = 1;

    $names = ['синяя рыба', 'малёк', 'обычная рыба'];  // Список доступных названий

    $check_sql = "SELECT * FROM user_items WHERE user_id='$user_id' AND item_id='$item_id'";
    $check_result = mysqli_query($connect, $check_sql);

    if (mysqli_num_rows($check_result) > 0) {
        $update_sql = "UPDATE user_items SET quantity = quantity + 1 WHERE user_id='$user_id' AND item_id='$item_id'";
        $update_result = mysqli_query($connect, $update_sql);

        if ($update_result) {
            $item_name = $names[array_rand($names)];  // Получаем случайное название из списка

            $_SESSION['message_fish'] = "Вы поймали: $item_name";

        } else {
            $_SESSION['message_fish'] = 'Не получается добавить рыбу в инвентарь';
        }
    } else {
        $add_sql = "INSERT INTO user_items (user_id, item_id, quantity) VALUES ('$user_id', '$item_id', '$quantity')";
        $add_result = mysqli_query($connect, $add_sql);

        if ($add_result) {
            $item_name = $names[array_rand($names)];  // Получаем случайное название из списка

            $_SESSION['message_fish'] = "Получил: $item_name";
        } else {
            $_SESSION['message_fish'] = "<p>Ошибка при попытке ловли рыбы!</p>";
        }
    }
    header('Location: ../rek.php');
    exit;
}

$data = array(
    'message_fish' => $_SESSION['message_fish']
);

echo json_encode($data);
exit;
