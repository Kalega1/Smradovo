<?php
session_start();
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
            echo $_SESSION['users']['email'];
        } else {
            echo "Не в сети";
        }
    ?>
  <header class="header">
  </header>
  <main>
    <h1 class="zag">СМРАДОВО</h1>
    



    <div class="ticket2">
      <form action="includes/signup.php" method="POST" class="style_ticket">
        <div class="column">
          <input class="input" name="login" id="" placeholder="Логин">
        </div>
        <div class="column">
          <input class="input" type="email" name="email" id="" placeholder="Почта">
        </div>
        <div class="column">
          <input class="input" type="password" name="password" id="" placeholder="Пароль">
        </div>
        <div class="column">
          <input class="input" type="password" name="password_confirm" id="" placeholder="Подтвердить пароль">
        </div>
        <p class="msg">
          <?php
            if (isset($_SESSION['message'])) {
                echo $_SESSION['message'];
                unset($_SESSION['message']);
            }
          ?> 
        </p>
        <div class="column">
          <button type="submit" class="signed">ЗАРЕГИСТРИРОВАТЬСЯ</button>
          <p>ЕСЛИ ВЫ УЖЕ ПРОПИСАНЫ В СМРАДОВО, <a href="index.php">ПЕРЕЙТИ</a></p>
        </div>
      </form>
    </div>
</body>
</html>
