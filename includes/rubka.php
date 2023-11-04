<?php
session_start();
require_once 'connect.php';

$user_id = $_SESSION['id']['id'];


if (isset($_POST['chop_tree'])) {
    
    // Проверка энергии пользователя
    $energy_check_sql = "SELECT energy FROM user_stats WHERE user_id='$user_id'";
    $energy_check_result = mysqli_query($connect, $energy_check_sql);
    $energy_check_row = mysqli_fetch_assoc($energy_check_result);
    $energy = $energy_check_row['energy'];

    if ($energy >= 2) { // Предполагаем, что срубка дерева требует 10 единиц энергии

        $tree_id = 5; // идентификатор дерева (в данном случае у нас только один вид дерева)
        $quantity = 1;

        $check_sql = "SELECT * FROM user_items WHERE user_id='$user_id' AND item_id='$tree_id'";
        $check_result = mysqli_query($connect, $check_sql);

        if (mysqli_num_rows($check_result) > 0) {
            // Проверяем наличие топора у пользователя
            $axe_check_sql = "SELECT * FROM user_items WHERE user_id='$user_id' AND item_id='1' AND quantity >= 1";
            $axe_check_result = mysqli_query($connect, $axe_check_sql);

            if (mysqli_num_rows($axe_check_result) > 0) {
                // Генерируем случайное число от 1 до 10
                $random_number = rand(1, 10);
                
                if ($random_number <= 1) { // Например, шанс сломаться топора составляет 30%
                    // Удаляем топор из инвентаря пользователя
                    $decrement_quantity_sql = "UPDATE user_items SET quantity = quantity - 1 WHERE user_id = '$user_id' AND item_id = '1' LIMIT 1";
                    $decrement_quantity_result = mysqli_query($connect, $decrement_quantity_sql);



                    if ($decrement_quantity_result) {
                        $_SESSION['message_der'] = 'Топор сломался!';
                    } else {
                        $_SESSION['message_der'] = 'Ошибка при удалении сломанного топора из инвентаря!';
                    }
                    
                } else {
                    // Уменьшаем количество топоров у пользователя
                    $update_tree_sql = "UPDATE user_items SET quantity = quantity + 1 WHERE user_id='$user_id' AND item_id='$tree_id'";
                    $update_tree_result = mysqli_query($connect, $update_tree_sql);

                    $decrement_energy_sql = "UPDATE user_stats SET energy = energy - 2 WHERE user_id = '$user_id'";
                    mysqli_query($connect, $decrement_energy_sql);

                    $_SESSION['message_der'] = ($update_tree_result) ? 'Вы добыли дерево' : 'Ошибка при добавлении дерева в инвентарь!';
                    
                }

            } else {
                $_SESSION['message_der'] = 'Нет топора!';
            }

            // Уменьшаем энергию у пользователя

        } else {
            $add_tree_sql = "INSERT INTO user_items (user_id, item_id, quantity) VALUES ('$user_id', '$item_id', '$quantity')";
            $add_tree_result = mysqli_query($connect, $add_tree_sql);

            if ($add_tree_result) {
                $_SESSION['message_der'] = '+🪵';
            } else {
                $_SESSION['message_der'] = 'Ошибка при добавлении дерева в инвентарь!';
            }

            // Уменьшаем энергию у пользователя
            $decrement_energy_sql = "UPDATE user_stats SET energy = energy - 10 WHERE user_id = '$user_id'";
            mysqli_query($connect, $decrement_energy_sql);
           
        }

    } else {
        $_SESSION['message_der'] = 'Нет энергии!';
    }

    header('Location: ../les.php');
    exit;
}

$data = array(
    'message_der' => $_SESSION['message_der']
);

echo json_encode($data);
exit;

  

?>
