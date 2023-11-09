<?php
session_start();
if (!isset($_SESSION['id'])) {
    header('location: /');
    exit;
}

?>

<?php require_once 'includes/connect.php'; ?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Инвентарь</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <!-- <script src="js/inv.js"></script> -->


</head>


<body>
    <div class="profile">
        <div>
            <p class="profile-info"><?php echo $_SESSION['id']['login'] ?></p>
            <p class="profile-info"><?php echo $stats_quantity ?></p>
            <p class="profile-info"><?php echo $stats2_quantity ?></p>

        </div>
    </div>

    <div class="inventory-container">
        <div class="inventory-grid">
            <table>
                <tr>
                    <th>Изображение</th>
                    <th>Название</th>
                    <th>Количество</th>
                    <th>Действие</th>
                </tr>
                <tr>
                    <td><img class="icon" src="jpg/der.png" alt="Tree"></td>
                    <td>Дерево</td>
                    <td><?php echo $tree_quantity ?></td>
                </tr>
                <tr>
                    <td><img class="icon" src="jpg/topor.png" alt="top"></td>
                    <td>Топоры</td>
                    <td><?php echo $axe_quantity ?></td>

                </tr>
                <tr>
                    <td><img class="icon" src="jpg/riba.png" alt="fish"></td>
                    <td>рыба</td>
                    <td><?php echo $fish_quantity ?></td>
                    <td>

                        <button id="eatButton">Съесть</button>


                    </td>
                    <td>

                        <button value="1">Передать</button>

                    </td>
                </tr>




                <tr>
                    <td><img class="icon" src="jpg/gov.png" alt="gov"></td>
                    <td>Говно</td>
                    <td><?php echo $gov_quantity ?></td>

                </tr>
                <tr>
                    <td><img class="icon" src="jpg/rud.png" alt="rud"></td>
                    <td>руда</td>
                    <td><?php echo $rud_quantity ?></td>

                </tr>
                <tr>
                    <td><img class="icon" src="jpg/ugol.webp" alt="ugol"></td>
                    <td>уголь</td>
                    <td><?php echo $ug_quantity ?></td>

                </tr>
                <tr>
                    <td><img class="icon" src="jpg/pogan.png" alt="поганка"></td>
                    <td>поганка</td>
                    <td><?php echo $pog_quantity ?></td>

                </tr>
                <tr>
                    <td><img class="icon" src="jpg/koren.png" alt="корень"></td>
                    <td>корень пустоты</td>
                    <td><?php echo $koren_quantity ?></td>

                </tr>
                <tr>
                    <td><img class="icon" src="jpg/ples.png" alt="плесень"></td>
                    <td>синяя плесень</td>
                    <td><?php echo $ples_quantity ?></td>

                </tr>
                <tr>
                    <td><img class="icon" src="jpg/yag.png" alt="ягода"></td>
                    <td>ягода</td>
                    <td><?php echo $yag_quantity ?></td>

                </tr>
                <tr>
                    <td><img class="icon" src="jpg/list.png" alt="лист"></td>
                    <td>вонючий лист</td>
                    <td><?php echo $list_quantity ?></td>

                </tr>



            </table>
        </div>
    </div>

    <div class="crafting-container">
    <h2>Рецепты крафта</h2>
    <ul>
        <?php if ($list_quantity >= 1 && $koren_quantity >= 1) { ?>
            <li>Рецепт чая</li>
        <?php } ?>
        <!-- Добавьте здесь больше рецептов крафта на основе доступных ингредиентов -->
    </ul>
</div>


    <script>
        function updateStats() {
            $.ajax({
                url: "includes/user_stat.php",
                type: "GET",
                dataType: "json",
                success: function(data) {
                    // Обновление значений на странице
                    if (data.tree_quantity) {
                        $('.inventory-grid table tr:eq(1)').show();
                        $('.inventory-grid table tr:eq(1) td:eq(2)').text(data.tree_quantity);
                    } else {
                        $('.inventory-grid table tr:eq(1)').hide();
                    }

                    if (data.axe_quantity) {
                        $('.inventory-grid table tr:eq(2)').show();
                        $('.inventory-grid table tr:eq(2) td:eq(2)').text(data.axe_quantity);
                    } else {
                        $('.inventory-grid table tr:eq(2)').hide();
                    }

                    if (data.fish_quantity) {
                        $('.inventory-grid table tr:eq(3)').show();
                        $('.inventory-grid table tr:eq(3) td:eq(2)').text(data.fish_quantity);
                    } else {
                        $('.inventory-grid table tr:eq(3)').hide();
                    }

                    if (data.gov_quantity) {
                        $('.inventory-grid table tr:eq(4)').show();
                        $('.inventory-grid table tr:eq(4) td:eq(2)').text(data.gov_quantity);
                    } else {
                        $('.inventory-grid table tr:eq(4)').hide();
                    }
                    if (data.rud_quantity) {
                        $('.inventory-grid table tr:eq(5)').show();
                        $('.inventory-grid table tr:eq(5) td:eq(2)').text(data.rud_quantity);
                    } else {
                        $('.inventory-grid table tr:eq(5)').hide();
                    }
                    if (data.ug_quantity) {
                        $('.inventory-grid table tr:eq(6)').show();
                        $('.inventory-grid table tr:eq(6) td:eq(2)').text(data.ug_quantity);
                    } else {
                        $('.inventory-grid table tr:eq(6)').hide();
                    }

                    if (data.pog_quantity) {
                        $('.inventory-grid table tr:eq(7)').show();
                        $('.inventory-grid table tr:eq(7) td:eq(2)').text(data.pog_quantity);
                    } else {
                        $('.inventory-grid table tr:eq(7)').hide();
                    }
                    if (data.koren_quantity) {
                        $('.inventory-grid table tr:eq(8)').show();
                        $('.inventory-grid table tr:eq(8) td:eq(2)').text(data.koren_quantity);
                    } else {
                        $('.inventory-grid table tr:eq(8)').hide(); 
                    }
                    if (data.ples_quantity) {
                        $('.inventory-grid table tr:eq(9)').show();
                        $('.inventory-grid table tr:eq(9) td:eq(2)').text(data.ples_quantity);
                    } else {
                        $('.inventory-grid table tr:eq(9)').hide();
                    }
                    if (data.yag_quantity) {
                        $('.inventory-grid table tr:eq(10)').show();
                        $('.inventory-grid table tr:eq(10) td:eq(2)').text(data.yag_quantity);
                    } else {
                        $('.inventory-grid table tr:eq(10)').hide();
                    }
                    if (data.list_quantity) {
                        $('.inventory-grid table tr:eq(11)').show();
                        $('.inventory-grid table tr:eq(11) td:eq(2)').text(data.list_quantity);
                    } else {
                        $('.inventory-grid table tr:eq(11)').hide();
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus + " " + errorThrown);
                }
            });
        }


        function updateStats1() {
            $.ajax({
                url: "includes/user_stat.php",
                type: "GET",
                dataType: "json",
                success: function(data) {
                    // Обновление значений на странице
                    $('.profile .profile-info:eq(1)').text("Здоровье: " + data.stats_quantity);
                    $('.profile .profile-info:eq(2)').text("Энергия: " + data.stats2_quantity);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus + " " + errorThrown);
                }
            });
        }

        updateStats();
        updateStats1();
    </script>

<script>
var eatButton = document.getElementById("eatButton");

// Привязываем обработчик события клика на кнопку
eatButton.addEventListener("click", function() {
    // Создаем новый AJAX-запрос
    var xhr = new XMLHttpRequest();

    // Определяем метод запроса и URL
    xhr.open("POST", "includes/eda.php", true);

    // Определяем заголовки
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    // Определяем обработчик ответа
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            // Обработка ответа на запрос
            var response = JSON.parse(xhr.responseText);
            var response = JSON.parse(xhr.responseText);

// Создаем новый элемент, чтобы показать сообщение
var messageDiv = document.createElement("div");

// Присваиваем ему класс для стилизации (если потребуется)
messageDiv.className = "responseMessage";

messageDiv.style.position = "absolute";
messageDiv.style.height = "65px";
messageDiv.style.width = "200px";
messageDiv.style.lineHeight = "25px";
messageDiv.style.color = "#155724";
messageDiv.style.textAlign = "center";
messageDiv.style.borderRadius = "25px";
messageDiv.style.left = "50%";
messageDiv.style.top = "50%";
messageDiv.style.transform = "translate(-50%, -50%)";
messageDiv.style.opacity = "0";
messageDiv.style.transition = "opacity 0.5s ease-in-out";
messageDiv.style.padding = "20px";

// Записываем сообщение в элемент
messageDiv.innerText = response.message_eda;

// Добавляем элемент в тело документа
document.body.appendChild(messageDiv);

// Показываем элемент (делаем его видимым)
setTimeout(function() {
  messageDiv.style.opacity = "1";
}, 100); // Появляется через 0.1 секунды

// Удаляем элемент через определенное время
setTimeout(function() {
  messageDiv.style.opacity = "0";
  setTimeout(function() {
    messageDiv.remove();
  }, 500); // Исчезает через 0.5 секунды
}, 3000); // Пребывает на экране 3 секунды
            

            updateStats(); // обновляем статистику инвентаря
            updateStats1(); // обновляем личную статистику

            // Уменьшаем количество рыбы на 1
            var fish_quantity = parseInt($('.inventory-grid table tr:eq(3) td:eq(2)').text());
            if (isNaN(fish_quantity)) {
                fish_quantity = 0;
            }
            if (fish_quantity > 0) {
                fish_quantity -= 1;
                $('.inventory-grid table tr:eq(3) td:eq(2)').text(fish_quantity);
            }
        }
    }

    // Формируем данные для отправки
    var data = "eat_fish=1";

    // Отправляем запрос с данными
    xhr.send(data);
});
</script>





</body>

</html>