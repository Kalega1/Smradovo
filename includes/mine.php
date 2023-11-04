<?php
session_start();
require_once 'connect.php';

$user_id = $_SESSION['id']['id'];

if (isset($_POST['catch_mine'])) {
    $item_id = null;  // Переменная для хранения ID предмета
    $quantity = 1;

    $names = ['руда', 'уголь', 'ничего'];  // Список доступных названий

    // Случайным образом определяем, какой предмет будет добываться
    $random_number = rand(1, 3);
    if ($random_number == 1) {
        $item_id = 3;  // Руда
    } elseif ($random_number == 2) {
        $item_id = 4;  // Уголь
    } else {
        // Если случайное число равно 3, то ничего не добывается
    }

    if ($item_id != null) {
        $check_sql = "SELECT * FROM user_items WHERE user_id='$user_id' AND item_id='$item_id'";
        $check_result = mysqli_query($connect, $check_sql);

        if (mysqli_num_rows($check_result) > 0) {
            $update_sql = "UPDATE user_items SET quantity = quantity + 1 WHERE user_id='$user_id' AND item_id='$item_id'";
            $update_result = mysqli_query($connect, $update_sql);

            if ($update_result) {
                $item_name = $names[$item_id - 3];  // Получаем название из списка

                $_SESSION['message_min'] = "Вы добыли: $item_name";

            } else {
                $_SESSION['message_min'] = 'Ошибка при попытке добавить предмет в инвентарь';
            }
        } else {
            $add_sql = "INSERT INTO user_items (user_id, item_id, quantity) VALUES ('$user_id', '$item_id', '$quantity')";
            $add_result = mysqli_query($connect, $add_sql);

            if ($add_result) {
                $item_name = $names[$item_id - 3];  // Получаем название из списка

                $_SESSION['message_min'] = "Получил: $item_name";
            } else {
                $_SESSION['message_min'] = 'Ошибка при попытке работать в шахте!';
            }
        }
    } else {
        $_SESSION['message_min'] = 'Ничего не добылось';
    }

    header('Location: ../profile.php');
    exit;
}

$data = array(
    'message_min' => $_SESSION['message_min']
);

echo json_encode($data);
exit;
