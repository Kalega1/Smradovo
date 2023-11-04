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
    
            <h2>Календарь</h2>
        
           <img src="/jpg/calendar.png" alt="календарь">
        
            

      </div>
  
      </div>
      <div class="scroll-bottom"></div>

  <!-- <img id="map" src="/jpg/svitok.png" alt="Смрадово"> -->
  </div>
</body>
</html>