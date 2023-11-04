<?php
session_start();
require_once 'connect.php';

$user_id = $_SESSION['id']['id'];

if (isset($_POST['catch_govno'])) {
    $item_id = 2; 
    $quantity = 1;

    $names = ['какашка', 'говен', 'жижа', 'понос', 
    'дрисня', 'куча', 'столб', 'крендель', 'россыпь', 
    'отвал', 'щебень', 'стул', 'помет', 'фекалия', 'слизь', 
    'нечистота', 'желчь', 'грязь', 'жижица', 'коричневый', 
    'рогалик', 'водопад','жидкость'];  // Список доступных названий

    $check_sql = "SELECT * FROM user_items WHERE user_id='$user_id' AND item_id='$item_id'";
    $check_result = mysqli_query($connect, $check_sql);

    if (mysqli_num_rows($check_result) > 0) {
        $update_sql = "UPDATE user_items SET quantity = quantity + 1 WHERE user_id='$user_id' AND item_id='$item_id'";
        $update_result = mysqli_query($connect, $update_sql);

        if ($update_result) {
            $item_name = $names[array_rand($names)];  // Получаем случайное название из списка

            $_SESSION['message_gov'] = "Вы раскопали: $item_name";

        } else {
            $_SESSION['message_gov'] = 'Ошибка при попытке добавить говно в инвентарь';
        }
    } else {
        $add_sql = "INSERT INTO user_items (user_id, item_id, quantity) VALUES ('$user_id', '$item_id', '$quantity')";
        $add_result = mysqli_query($connect, $add_sql);

        if ($add_result) {
            $item_name = $names[array_rand($names)];  // Получаем случайное название из списка

            $_SESSION['message_gov'] = "Получил: $item_name";
        } else {
            $_SESSION['message_gov'] = "<p>Ошибка при попытке копнуть говна!</p>";
        }
    }
    header('Location: ../profile.php');
    exit;
}

$data = array(
    'message_gov' => $_SESSION['message_gov']
);

echo json_encode($data);
exit;
