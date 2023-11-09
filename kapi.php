
<?php
session_start();
if (!isset($_SESSION['id'])) {
  header('location: /');
  exit;
}

?>

<?php require_once 'includes/connect.php'; ?>





<?php

$user_id = $_SESSION['id']['id'];

?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Капище</title>
  <link rel="stylesheet" href="/style.css">
  <link rel="stylesheet" href="/chat.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</head>

<body>







  <div class="login-wrapper">
  <p class="login"></p>
    <p class="login"></p>
    <p class="login"></p>
    <p class="login"></p>
    <p class="login"><?php echo $_SESSION['id']['login'] ?></p>
    <a class="login" href="inv.php" class="link">💼</a>
  </div>
  <img id="map" src="/jpg/kapi.jpg" alt="капище">
  </div>


  

  




</body>

</html>