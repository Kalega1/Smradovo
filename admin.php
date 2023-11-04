
<?php
session_start();
if (!isset($_SESSION['id'])) {
  header('location: /');
  exit;
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Администрация</title>
  <link rel="stylesheet" href="/style.css">
  <link rel="stylesheet" href="/chat.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
  <style>
    .tabs {
      margin-top: 20px;
    }
    .tabs .ui-tabs-panel {
      display: none;
    }
  </style>
  <script>
    $(function() {
      $(".tabs").tabs();
    });
  </script>
</head>
<body>
  <div class="tabs">
    <ul>
      <li><a href="#tab1">Вкладка 1</a></li>
      <li><a href="#tab2">Вкладка 2</a></li>
      <li><a href="#tab3">Вкладка 3</a></li>
    </ul>
    <div id="tab1">
      <h2>Содержимое вкладки 1</h2>
      <p>Здесь может быть ваша информация для вкладки 1.</p>
    </div>
    <div id="tab2">
      <h2>Содержимое вкладки 2</h2>
      <p>Здесь может быть ваша информация для вкладки 2.</p>
    </div>
    <div id="tab3">
      <h2>Содержимое вкладки 3</h2>
      <p>Здесь может быть ваша информация для вкладки 3.</p>
    </div>
  </div>
</body>
</html>