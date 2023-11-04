<?
session_start();
require_once 'connect.php';

if (!isset($_SESSION['id']['id'])) {
    $data = array(
        'message_eda' => "Вы не авторизованы."
    );
    echo json_encode($data);
    exit;
}

$user_id = $_SESSION['id']['id'];

if (isset($_POST['eat_fish'])) {
    $item_id = 6;

    // Проверяем наличие рыбы в инвентаре
    $check_fish_sql = "SELECT quantity FROM user_items WHERE user_id='$user_id' AND item_id='$item_id'";
    $check_fish_result = mysqli_query($connect, $check_fish_sql);
    $user_fish_quantity = mysqli_fetch_assoc($check_fish_result)['quantity'];
    
    // Проверьте текущее здоровье пользователя
    $check_health_sql = "SELECT health FROM user_stats WHERE user_id='$user_id'";
    $check_health_result = mysqli_query($connect, $check_health_sql);
    $user_health = mysqli_fetch_assoc($check_health_result)['health'];

    // Проверка, что здоровье меньше 100, и что в результате запроса есть основные данные, и что количество рыбы >0
    if ($check_fish_result && mysqli_num_rows($check_fish_result) > 0 && $user_health < 100 && $user_fish_quantity > 0) {
        $fish_health = 3;

        $update_health_sql = "UPDATE user_stats SET health = LEAST(health + $fish_health, 100) WHERE user_id='$user_id'";
        $update_health_result = mysqli_query($connect, $update_health_sql);

        if ($update_health_result) {
            $decrease_fish_quantity_sql = "UPDATE user_items SET quantity = quantity - 1 WHERE user_id='$user_id' AND item_id='$item_id'";
            mysqli_query($connect, $decrease_fish_quantity_sql);

            $message = "Вы съели рыбу и восстановили $fish_health хп.";
        } else {
            $message = "Ошибка при обновлении здоровья.";
        }
    } elseif ($user_health == 100) {
        $message = "Вы наелись";
    } elseif ($user_fish_quantity <= 0) {
        // Если количество рыбы в инвентаре равно нулю или меньше
        $message = "У вас нет рыбы в инвентаре.";
    }
} else {
    $message = "Не был выполнен запрос на съедание рыбы.";
}

$data = array(
    'message_eda' => $message,
    // Вместо 'message_eda' возможно было подразумевано $_SESSION['message_eda']
);

echo json_encode($data);
exit;

?>