// Получаем ссылку на элемент inventory-grid
var inventoryGrid = document.querySelector('.inventory-grid');

// Создаем элементы инвентаря
var item1 = document.createElement('div');
item1.innerText = 'Item 1';

var item2 = document.createElement('div');
item2.innerText = 'Item 2';

// Добавляем элементы в inventory-grid
inventoryGrid.appendChild(item1);
inventoryGrid.appendChild(item2);
