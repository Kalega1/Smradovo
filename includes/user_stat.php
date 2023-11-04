<?php
session_start();
require_once 'connect.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);
    
if (mysqli_connect_errno()) {
    die('Failed to connect to MySQL: ' . mysqli_connect_error());
}

$user_id = $_SESSION['id']['id'];

//топор
$get_axe_sql = "SELECT quantity FROM user_items WHERE user_id='$user_id' AND item_id='1'";
$get_axe_result = mysqli_query($connect, $get_axe_sql);
$axe_quantity = 0;

if ($get_axe_result && mysqli_num_rows($get_axe_result) > 0) {
    $axe_row = mysqli_fetch_assoc($get_axe_result);
    $axe_quantity = $axe_row['quantity'];
}
//здоровье
$get_stats_sql = "SELECT health FROM user_stats WHERE user_id = '$user_id'";
$get_stats_result = mysqli_query($connect, $get_stats_sql);
$stats_quantity = 0;

if ($get_stats_result && mysqli_num_rows($get_stats_result) > 0) {
    $stats_row = mysqli_fetch_assoc($get_stats_result);
    $stats_quantity = $stats_row['health'];
}
//энергия
$get_stats2_sql = "SELECT energy FROM user_stats WHERE user_id = '$user_id'";
$get_stats2_result = mysqli_query($connect, $get_stats2_sql);
$stats2_quantity = 0;

if ($get_stats2_result && mysqli_num_rows($get_stats2_result) > 0) {
    $stats2_row = mysqli_fetch_assoc($get_stats2_result);
    $stats2_quantity = $stats2_row['energy'];
}
//рыба
$get_fish_sql = "SELECT quantity FROM user_items WHERE user_id='$user_id' AND item_id='6'";
$get_fish_result = mysqli_query($connect, $get_fish_sql);
$fish_quantity = 0;

if ($get_fish_result && mysqli_num_rows($get_fish_result) > 0) {
    $fish_row = mysqli_fetch_assoc($get_fish_result);
    $fish_quantity = $fish_row['quantity'];
}

//говно
$get_gov_sql = "SELECT quantity FROM user_items WHERE user_id='$user_id' AND item_id='2'";
$get_gov_result = mysqli_query($connect, $get_gov_sql);
$gov_quantity = 0;

if ($get_gov_result && mysqli_num_rows($get_gov_result) > 0) {
    $gov_row = mysqli_fetch_assoc($get_gov_result);
    $gov_quantity = $gov_row['quantity'];
}
//руда
$get_rud_sql = "SELECT quantity FROM user_items WHERE user_id='$user_id' AND item_id='3'";
$get_rud_result = mysqli_query($connect, $get_rud_sql);
$rud_quantity = 0;

if ($get_rud_result && mysqli_num_rows($get_rud_result) > 0) {
    $rud_row = mysqli_fetch_assoc($get_rud_result);
    $rud_quantity = $rud_row['quantity'];
}
//уголь
$get_ug_sql = "SELECT quantity FROM user_items WHERE user_id='$user_id' AND item_id='4'";
$get_ug_result = mysqli_query($connect, $get_ug_sql);
$ug_quantity = 0;

if ($get_ug_result && mysqli_num_rows($get_ug_result) > 0) {
    $ug_row = mysqli_fetch_assoc($get_ug_result);
    $ug_quantity = $ug_row['quantity'];
}
//дерево
$get_tree_sql = "SELECT quantity FROM user_items WHERE user_id='$user_id' AND item_id='5'";
$get_tree_result = mysqli_query($connect, $get_tree_sql);
$tree_quantity = 0;

if ($get_tree_result && mysqli_num_rows($get_tree_result) > 0) {
    $tree_row = mysqli_fetch_assoc($get_tree_result);
    $tree_quantity = $tree_row['quantity'];
}
//поганка
$get_pog_sql = "SELECT quantity FROM user_items WHERE user_id='$user_id' AND item_id='7'";
$get_pog_result = mysqli_query($connect, $get_pog_sql);
$pog_quantity = 0;

if ($get_pog_result && mysqli_num_rows($get_pog_result) > 0) {
    $pog_row = mysqli_fetch_assoc($get_pog_result);
    $pog_quantity = $pog_row['quantity'];
}
//корень
$get_koren_sql = "SELECT quantity FROM user_items WHERE user_id='$user_id' AND item_id='8'";
$get_koren_result = mysqli_query($connect, $get_koren_sql);
$koren_quantity = 0;

if ($get_koren_result && mysqli_num_rows($get_koren_result) > 0) {
    $koren_row = mysqli_fetch_assoc($get_koren_result);
    $koren_quantity = $koren_row['quantity'];
}
//плесень
$get_ples_sql = "SELECT quantity FROM user_items WHERE user_id='$user_id' AND item_id='9'";
$get_ples_result = mysqli_query($connect, $get_ples_sql);
$ples_quantity = 0;

if ($get_ples_result && mysqli_num_rows($get_ples_result) > 0) {
    $ples_row = mysqli_fetch_assoc($get_ples_result);
    $ples_quantity = $ples_row['quantity'];
}
//ягода
$get_yag_sql = "SELECT quantity FROM user_items WHERE user_id='$user_id' AND item_id='10'";
$get_yag_result = mysqli_query($connect, $get_yag_sql);
$yag_quantity = 0;

if ($get_yag_result && mysqli_num_rows($get_yag_result) > 0) {
    $yag_row = mysqli_fetch_assoc($get_yag_result);
    $yag_quantity = $yag_row['quantity'];
}
//лист
$get_list_sql = "SELECT quantity FROM user_items WHERE user_id='$user_id' AND item_id='11'";
$get_list_result = mysqli_query($connect, $get_list_sql);
$list_quantity = 0;

if ($get_list_result && mysqli_num_rows($get_list_result) > 0) {
    $list_row = mysqli_fetch_assoc($get_list_result);
    $list_quantity = $list_row['quantity'];
}


$data = array(
    "axe_quantity" => $axe_quantity,
    "stats_quantity" => $stats_quantity,
    "stats2_quantity" => $stats2_quantity,
    "fish_quantity" => $fish_quantity,
    "gov_quantity" => $gov_quantity,
    "rud_quantity" => $rud_quantity,
    "ug_quantity" => $ug_quantity,
    "tree_quantity" => $tree_quantity,
    "pog_quantity" => $pog_quantity,
    "koren_quantity" => $koren_quantity,
    "ples_quantity" => $ples_quantity,
    "yag_quantity" => $yag_quantity,
    "list_quantity" => $list_quantity,
    

);

echo json_encode($data);

?>
