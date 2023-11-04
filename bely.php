
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
  <title>Белый лес</title>
  <link rel="stylesheet" href="/style.css">
  <link rel="stylesheet" href="/chat.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</head>

<body>




  <div class="wrapper">
    <div class="smrad_wrapper">
      <svg class="svg" viewbox="0 0 1821.3333 1024">
        <foreignObject x="800.32332" y="500.8043" width="280" height="200">
          <form method="POST" action="includes/sbor.php">
            <input type='hidden' name='catch_sbor' value='1'>
            <div class="res">
            <p class="result" id="result"></p>
              <div class="progress">
                <div class="progress-bar" id="progress-bar" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
              <button class="button" id="chop_tree_button" type="submit" name="catch_sbor">собирать</button>
            </div>
          </form>
        </foreignObject>
      </svg>
    </div>
  </div>


  <div class="login-wrapper">
  <p class="login"></p>
    <p class="login"></p>
    <p class="login"></p>
    <p class="login"></p>
    <p class="login"><?php echo $_SESSION['id']['login'] ?></p>
    <a class="login" href="inv.php" class="link">💼</a>
  </div>
  <img id="map" src="/jpg/bely.jpg" alt="белый лес">
  </div>


  <script>
    // Отображение прогрессбара вместе с таймером
    function startTimer() {
      var timerValue = 10;
      var progressBar = document.getElementById("progress-bar");
      var progress = 0;
      var progressStep = 100 / timerValue;
      $('#chop_tree_button').prop('disabled', true); // выключаем кнопку
      $.ajax({
        url: "includes/sbor.php",
        type: "GET",
        dataType: "json",
        success: function(data) {
          $('#result').text(data.message_sbor);
        },
        error: function(jqXHR, textStatus, errorThrown) {
          $('#result').html('Ошибка: ' + textStatus);
        }
      });
      // установка анимации для прогресс бара
      progressBar.style.transition = "width " + (progressStep * 1) + "ms linear";
      var timerInterval = setInterval(function() {
        progress += progressStep;
        progressBar.style.width = progress + "%";
        timerValue--;
        if (timerValue >= 0) {
          $('#timer').text(timerValue);
        }
        if (timerValue === 0) {
          clearInterval(timerInterval); // останавливаем интервал
          $('#chop_tree_button').prop('disabled', false); // включаем кнопку
          progressBar.style.width = "0%"; // сбрасываем прогресс бар до нуля
        }
      }, 1000); // интервал в 1 секунду
    }
    $(document).ready(function() {
      $('#chop_tree_button').click(function() {
        startTimer();
      });
    });
  </script>

  <script>
    $(document).ready(function() {
      function updateStats() {
        $.ajax({
          url: "includes/user_stat.php",
          type: "GET",
          dataType: "json",
          success: function(data) {
            $('.login-wrapper .login:eq(2)').text("❤️: " + data.stats_quantity);
            $('.login-wrapper .login:eq(3)').text("⚡️: " + data.stats2_quantity);
          },
          error: function(jqXHR, textStatus, errorThrown) {
            console.log(textStatus + " " + errorThrown);
          }
        });
      }
      $('#chop_tree_button').click(function() {
        // Выполнение AJAX-запроса
        $.ajax({
          url: "includes/sbor.php",
          type: "POST",
          data: {
            catch_sbor: 1
          },
          success: function(data) {
            updateStats();
          },
          error: function(jqXHR, textStatus, errorThrown) {
            console.log(textStatus + " " + errorThrown);
          }
        });
      });
      updateStats();
    });
  </script>




</body>

</html>