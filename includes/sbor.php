<?php
session_start();
require_once 'connect.php';

$user_id = $_SESSION['id']['id'];

if (isset($_POST['catch_sbor'])) {
    $item_id = null;  // Переменная для хранения ID предмета
    $quantity = 1;

    $names = ['поганка', 'корень', 'плесень','ягода','лист'];  // Список доступных названий

    // Случайным образом определяем, какой предмет будет добываться
    $random_number = rand(1, 5);
    if ($random_number == 1) {
        $item_id = 7;  // поганка
    } elseif ($random_number == 2) {
        $item_id = 8;  // корень
    } elseif ($random_number == 3) {
        $item_id = 9;  // плесень
    } elseif ($random_number == 4) {
        $item_id = 10;  // ягода
    } elseif ($random_number == 5) {
        $item_id = 11;  // лист
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
                $item_name = $names[$item_id - 7];  // Получаем название из списка

                $_SESSION['message_sbor'] = "Вы собрали: $item_name";

            } else {
                $_SESSION['message_sbor'] = 'Ошибка при попытке добавить предмет в инвентарь';
            }
        } else {
            $add_sql = "INSERT INTO user_items (user_id, item_id, quantity) VALUES ('$user_id', '$item_id', '$quantity')";
            $add_result = mysqli_query($connect, $add_sql);

            if ($add_result) {
                $item_name = $names[$item_id - 7];  // Получаем название из списка

                $_SESSION['message_sbor'] = "Получил: $item_name";
            } else {
                $_SESSION['message_sbor'] = 'Ошибка при попытке собрать травы!';
            }
            
        } 
        
        
    } else {
        $_SESSION['message_sbor'] = 'Ничего не добылось';
    }

    header('Location: ../profile.php');
    exit;
}

$data = array(
    'message_sbor' => $_SESSION['message_sbor']
);

echo json_encode($data);
exit;
