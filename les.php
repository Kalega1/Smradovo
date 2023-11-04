
<?php
session_start();
if (!isset($_SESSION['id'])) {
  header('location: /');
  exit;
}

?>

<?php require_once 'includes/connect.php'; ?>

<?php

if (isset($_POST['submit'])) {
  $user = $_POST['user'];
  $message = $_POST['message'];
  if (!empty($user) && !empty($message)) {
    $sql = "INSERT INTO messages_les (user, message) VALUES ('$user', '$message')";
    mysqli_query($connect, $sql);

    header('location: ' . $_SERVER['PHP_SELF']);
    exit;
  }
}

$sql = "SELECT * FROM messages_les ORDER BY created_at ASC";
$result = mysqli_query($connect, $sql);
?>


<?php

$user_id = $_SESSION['id']['id'];

?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Черный лес</title>
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
          <form method="POST" action="includes/rubka.php">
            <input type='hidden' name='chop_tree' value='1'>
            <div class="res">
            <p class="result" id="result"></p>
              <div class="progress">
                <div class="progress-bar" id="progress-bar" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
              <button class="button" id="chop_tree_button" type="submit" name="chop_tree">рубить</button>
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

  <img id="map" src="/jpg/les.png" alt="les">
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
        url: "includes/rubka.php",
        type: "GET",
        dataType: "json",
        success: function(data) {
          $('#result').text(data.message_der);
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
          url: "includes/rubka.php",
          type: "POST",
          data: {
            chop_tree: 1
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

  <script>
    function
    toggleChat() {
      const chatContainer = document.getElementById('chat-container');
      chatContainer.classList.toggle('minimize');
    }
    window.addEventListener('DOMContentLoaded', (event) => {
      var chatMessages = document.getElementById("chat-messages");
      chatMessages.scrollTop = chatMessages.scrollHeight;
    });
  </script>


  <div id="chat-container" class="minimize">
    <div id="chat-header" onclick="toggleChat()">+</div>
    <div id="chat-body">
      <div id="chat-messages">
        <?php while ($row = mysqli_fetch_assoc($result)) : ?>
          <p><strong><?= $row['user'] ?>:</strong> <?= $row['message'] ?></p>
        <?php endwhile; ?>
      </div>
      <form method="POST" action="">
        <div id="chat-input">
          <textarea class="chat" name="message" placeholder="Введите сообщение" required></textarea>
          <button type="submit" name="submit">Отправить</button>
        </div>
        <input class="name" type="text" name="user" value="<?= $_SESSION['id']['login'] ?>" readonly required>
      </form>
    </div>
  </div>

  <style>
table {
            border-collapse: collapse;
            width: 100%;
        }
        
        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
</style>

<h2>Топ 5 лесорубов</h2>
<table>
    <tr>
        <th>Имя</th>
        <th>Количество дерева</th>
        <th>Название</th>
    </tr>
    <?php
    $sql = "SELECT user_id, quantity, item_id FROM user_items WHERE item_id = 5 ORDER BY quantity DESC LIMIT 5";
    $result = $connect->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $user_query = mysqli_query($connect, "SELECT login FROM users WHERE id = " . $row['user_id']);
            $user_row = mysqli_fetch_assoc($user_query);

            $item_query = mysqli_query($connect, "SELECT name FROM items WHERE id = " . $row['item_id']);
            $item_row = mysqli_fetch_assoc($item_query);
            ?>
            <tr>
                <td><?php echo htmlspecialchars($user_row["login"]); ?></td>
                <td><?php echo htmlspecialchars($row["quantity"]); ?></td>
                <td><?php echo htmlspecialchars($item_row["name"]); ?></td>
            </tr>
            <?php
        }
    } else {
        ?>
        <tr>
            <td colspan="3">Нет данных</td>
        </tr>
        <?php
    }
    $connect->close();
    ?>
</table>


</body>

</html>