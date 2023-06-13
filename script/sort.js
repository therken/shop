// Функция для сортировки товаров по цвету
function sortProductsByColor() {
    // Получаем все товары
    var productsContainer = document.getElementById("all");
    var products = productsContainer.getElementsByClassName("product");
  
    // Получаем выбранные цвета
    var selectedColors = [];
    var checkboxes = document.querySelectorAll("input[type='checkbox'][name='color']");
    
    // Проходимся по всем флажкам и добавляем выбранные цвета в массив
    for (var i = 0; i < checkboxes.length; i++) {
      if (checkboxes[i].checked) {
        selectedColors.push(checkboxes[i].getAttribute("data-color"));
      }
    }
  
    // Проходимся по всем товарам и скрываем или показываем их в зависимости от выбранных цветов
    for (var j = 0; j < products.length; j++) {
      var product = products[j];
      var productColor = product.getAttribute("data-color");
      
      if (selectedColors.length === 0 || selectedColors.includes(productColor)) {
        product.style.display = "block"; // Показываем товар
      } else {
        product.style.display = "none"; // Скрываем товар
      }
    }
  }
  
  // Находим все флажки по имени и назначаем обработчик события изменения состояния
  var checkboxes = document.querySelectorAll("input[type='checkbox'][name='color']");
  for (var k = 0; k < checkboxes.length; k++) {
    checkboxes[k].addEventListener("change", sortProductsByColor);
  }

  // Функция для сортировки товаров по дням доставки с различными диапазонами времени
function sortProductsByDeliveryTime() {
  // Получаем все товары
  var productsContainer = document.getElementById("all");
  var products = productsContainer.getElementsByClassName("product");

  // Получаем выбранные диапазоны времени доставки
  var selectedTimeRanges = [];
  var checkboxes = document.querySelectorAll("input[type='checkbox'][name='delivery-time']");
  
  // Проходимся по всем флажкам и добавляем выбранные диапазоны времени в массив
  for (var i = 0; i < checkboxes.length; i++) {
    if (checkboxes[i].checked) {
      selectedTimeRanges.push(checkboxes[i].getAttribute("data-time-range"));
    }
  }

  // Проходимся по всем товарам и скрываем или показываем их в зависимости от выбранных диапазонов времени доставки
  for (var j = 0; j < products.length; j++) {
    var product = products[j];
    var deliveryTimeRange = product.getAttribute("data-delivery-time-range");
    
    if (selectedTimeRanges.length === 0 || selectedTimeRanges.includes(deliveryTimeRange)) {
      product.style.display = "block"; // Показываем товар
    } else {
      product.style.display = "none"; // Скрываем товар
    }
  }
}

// Находим все флажки по имени и назначаем обработчик события изменения состояния
var checkboxes = document.querySelectorAll("input[type='checkbox'][name='delivery-time']");
for (var k = 0; k < checkboxes.length; k++) {
  checkboxes[k].addEventListener("change", sortProductsByDeliveryTime);
}

  