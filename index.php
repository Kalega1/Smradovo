<?php
session_start();

// Проверяем, был ли отмечен чекбокс "Оставаться в сети"
$rememberMe = isset($_POST['remember']) ? true : false;

// if ($_SESSION['users']) {
//   header('location: profile.php'); 
// }
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <title>СМРАДОВО</title>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</head>

<body>
<div class="background-image"></div>

  <?php
  if (isset($_SESSION['users'])) {
    header('location: profile.php');
    echo $_SESSION['users']['login'];
    echo $_SESSION['users']['avatar'];
    echo $_SESSION['users']['email'];
  } else {
    echo "Вы не зашли";
  }
  ?>

  <header class="header">
  </header>
  <main class="main">

    <h1 class="zag">СМРАДОВО</h1>
    <p class="podzag">ДОБРО ПОЖАЛОВАТЬ!</p>
    



    <div class="ticket2">
      <form action="includes/signin.php" method="post" name="login" class="style_ticket">
        <div class="column">
          <input type="text" name="login" placeholder="Логин">
        </div>
        <div class="column">

          <input type="password" name="password" placeholder="Пароль">
        </div>
        <div class="column">
          <?php
          if ($rememberMe) {
            echo '<input type="checkbox" name="remember" checked> ОСТАВАТЬСЯ В СЕТИ';
          } else {
            echo '<input type="checkbox" name="remember"> ОСТАВАТЬСЯ В СЕТИ';
          }
          ?>
        </div>
        <div class="column">
          <button type="submit" class="signed">ОК</button>
          <p> ЕСЛИ У ВАС ЕЩЕ НЕТ ПРОПИСКИ, <a href="registration.php">РЕГИСТРАЦИЯ</a> </p>
          <p class="msg"><?php
                        if (isset($_SESSION['message'])) {
                          echo $_SESSION['message'];
                          unset($_SESSION['message']);
                        }
                        ?></p>
        </div>
      </form>
    </div>

  </main>

</body>

</html>
