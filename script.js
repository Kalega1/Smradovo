window.onload = function() {
    var mapSize = 5; // Размер карты (количество клеток на оси)
  
    var map = document.getElementById("map");
    var cellSize = map.offsetWidth / mapSize;
  
    // Создание сетки клеток
    for (var y = 0; y < mapSize; y++) {
      for (var x = 0; x < mapSize; x++) {
        var cell = document.createElement("div");
        cell.className = "cell";
        cell.style.top = y * cellSize + "px";
        cell.style.left = x * cellSize + "px";
        map.appendChild(cell);
      }
    }
  
    // Пример использования данных ресурсов (JSON)
    var resources = [
      { x: 1, y: 2, type: "дерево", amount: 50 },
      { x: 3, y: 4, type: "камень", amount: 30 }
      // и другие данные по ресурсам в каждой клетке
    ];
  
    // Отображение данных ресурсов
    for (var i = 0; i < resources.length; i++) {
      var resource = resources[i];
      var cellIndex = resource.y * mapSize + resource.x;
      var targetCell = map.childNodes[cellIndex];
  
      var resourceDiv = document.createElement("div");
      resourceDiv.className = "resource";
      resourceDiv.textContent = resource.type + ": " + resource.amount;
      targetCell.appendChild(resourceDiv);
    }
  };
  