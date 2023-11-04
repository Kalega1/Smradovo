<?php
session_start();
if (!isset($_SESSION['id'])) {
  header('location: /');
  exit;
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Школа</title>
    <link rel="stylesheet" href="../shcool.css">
    <link rel="stylesheet" href="../style.css">
  <link rel="stylesheet" href="../chat.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
  <link href="https://myfonts.ru/myfonts?fonts=vezitsa" rel="stylesheet" type="text/css" />
</head>
<body>
    
  <div>

  <div class="scroll-container">
        <div class="scroll-top"></div>
        <div class="scroll-middle">
          <div class="content">
            <H1>Школьная энциклопедия <a class="ssilka" href="smradopedia.php">Смрадово</a></H1>
    
            <h2>История и описание</h2>
        
            <p>Смрадово - (назв. от реки <a class="ssilka" href="smradka.php" alt="река">смрадка</a>) это языческая деревня, 
              основанная <a class="ssilka" href="calendar.php">1 беспорядка 00 кизячка</a>. <a class="ssilka" href="jitel.php" alt="река">жители</a> Смрадово это племя, 
              поклоняющееся Богу Калеге и восьми духам. </p>
        
            <p>Смрадово делится на великие дома (группы семей): Белый Хутор на югозападе, Куе на северозападе и Заречье на востоке. 
        за краем деревни находится бесконечная пустота, в которой живет Бог Калега. 
        В деревне нет женщин, жителей рожает великая МАМА.</p>
        
        <h2>География и природа</h2>
        
        <p>
        Смрадово находится на равнине между двух рек, смрадка и тухлянка. 
        из смрадки выходит ручей кристальный и впадает в озеро пекинка. 
        На западе, за смрадкой находится черная скала, которая богата рудами, углем и камнем. 
        В Смрадово есть два массивных леса, черный лес на севере - хвойный.  и белый лес на юге - лиственный. 
        Вдоль реки тухлянки находятся богатые на растительность луга. 
        </p>
        <h2>Климат</h2>
        <p>Резко-континентальный. Летом температура может подниматься до 25 градусов, зимой до -30. 
          Снег выпадает в месяц зис. Пик холодной погоды приходится на Июль.</p>

        <p></p>

      </div>
  
      </div>
      <div class="scroll-bottom"></div>

  <!-- <img id="map" src="/jpg/svitok.png" alt="Смрадово"> -->
  </div>
</body>
</html>