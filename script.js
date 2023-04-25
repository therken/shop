$(document).ready(function(){
  $('#search').click(function(){
     $('.menu-item').addClass('hide-item')
      $('.search-form').addClass('active')
      $('.close').addClass('active')
      $('#search').hide()
  })
  
   $('.close').click(function(){
     $('.menu-item').removeClass('hide-item')
      $('.search-form').removeClass('active')
      $('.close').removeClass('active')
       $('#search').show()
  })
  
})
const searchInput = document.querySelector("#search-input");
const cardsContainer = document.querySelector(".container");

searchInput.addEventListener("input", function () {
const searchValue = this.value.toLowerCase();

cardsContainer.querySelectorAll(".product").forEach(function (card) {
const cardTitle = card.querySelector(".description").textContent.toLowerCase();

if (cardTitle.includes(searchValue)) {
card.style.display = "block";
} else {
card.style.display = "none";
}
});
});

let preveiwContainer = document.querySelector('.products-preview');
let previewBox = preveiwContainer.querySelectorAll('.preview');

document.querySelectorAll('.products-container .product').forEach(product =>{
product.onclick = () =>{
preveiwContainer.style.display = 'flex';
let name = product.getAttribute('data-name');
previewBox.forEach(preview =>{
let target = preview.getAttribute('data-target');
if(name == target){
preview.classList.add('active');
}
});
};
});

previewBox.forEach(close =>{
close.querySelector('.fa-times').onclick = () =>{
close.classList.remove('active');
preveiwContainer.style.display = 'none';
};
});
// Открытие модалки
const cart = document.querySelector('#cart');
const cartModalOverlay = document.querySelector('.cart-modal-overlay');

cart.addEventListener('click', () => {
if (cartModalOverlay.style.transform === 'translateX(-200%)'){
cartModalOverlay.style.transform = 'translateX(0)';
} else {
cartModalOverlay.style.transform = 'translateX(-200%)';
}
})
//Открытие модалки

// Закрытие модалки
const closeBtn = document.querySelector ('#close-btn');

closeBtn.addEventListener('click', () => {
cartModalOverlay.style.transform = 'translateX(-200%)';
});

cartModalOverlay.addEventListener('click', (e) => {
if (e.target.classList.contains('cart-modal-overlay')){
cartModalOverlay.style.transform = 'translateX(-200%)'
}
})
// Закрытие модалки

// Добавление товаров в корзину
const addToCart = document.getElementsByClassName('add-to-cart');
const productRow = document.getElementsByClassName('product-row');

for (var i = 0; i < addToCart.length; i++) {
button = addToCart[i];
button.addEventListener('click', addToCartClicked)
}

function addToCartClicked (event) {
button = event.target;
var cartItem = button.parentElement;
var price = cartItem.getElementsByClassName('product-price')[0].innerText;
var description =cartItem.getElementsByClassName('description')[0].innerText;
var imageSrc = cartItem.getElementsByClassName('product-image')[0].src;
addItemToCart (price, imageSrc,description);
updateCartPrice()
}
function getCartItemsFromCookie() {
  const cartItems = JSON.parse(getCookie('cartItems')) || [];
  cartItems.forEach(item => {
    addItemToCart(item.price, item.imageSrc, item.description);
  });
  updateCartPrice();
}
window.addEventListener('load', getCartItemsFromCookie);

function addItemToCart (price, imageSrc,description) {
var productRow = document.createElement('div');
productRow.classList.add('product-row');
var productRows = document.getElementsByClassName('product-rows')[0];
var cartImage = document.getElementsByClassName('cart-image');

for (var i = 0; i < cartImage.length; i++){
if (cartImage[i].src == imageSrc){
alert ('This item has already been added to the cart')
return;
}
}

var cartRowItems = `
<div class="product-row">
<img class="cart-image" src="${imageSrc}" alt="">
<span class="description">${description}</span>
<span class ="cart-price">${price}</span>
<input class="product-quantity" type="number" value="1" max=3>
<span>Размер</span>
<input class="size" type="number" value="38"  min="38" max="48">
<button class="remove-btn">x</button>
</div>

`
productRow.innerHTML = cartRowItems;
productRows.append(productRow);
productRow.getElementsByClassName('remove-btn')[0].addEventListener('click', removeItem)
productRow.getElementsByClassName('product-quantity')[0].addEventListener('change', changeQuantity)
updateCartPrice()
const cartItems = JSON.parse(getCookie('cartItems')) || [];
  const item = { price, imageSrc, description };
  const index = cartItems.findIndex(i => i.imageSrc === imageSrc);
  if (index === -1) {
    cartItems.push(item);
  } else {
    cartItems[index] = item;
  }
  setCookie('cartItems', JSON.stringify(cartItems), 7);
}
// Добавление товаров в корзину

//Сохранение товаров в куки
function setCookie(name, value, days) {
  const date = new Date();
  date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
  const expires = "expires=" + date.toUTCString();
  document.cookie = name + "=" + value + ";" + expires + ";path=/";
}

function getCookie(name) {
  const cookieName = name + "=";
  const cookies = document.cookie.split(';');
  for (let i = 0; i < cookies.length; i++) {
    let cookie = cookies[i].trim();
    if (cookie.indexOf(cookieName) === 0) {
      return cookie.substring(cookieName.length, cookie.length);
    }
  }
  return null;
}

// Удаление товаров с корзины
const removeBtn = document.getElementsByClassName('remove-btn');
for (var i = 0; i < removeBtn.length; i++) {
  button = removeBtn[i]
  button.addEventListener('click', removeItem)
}

function removeItem (event) {
  btnClicked = event.target
  btnClicked.parentElement.parentElement.remove()
  updateCartPrice()
  
  // получаем текущее значение куки
  const cartItems = JSON.parse(getCookie('cartItems') || '[]');
  
  // находим индекс товара, который нужно удалить
  const index = cartItems.findIndex((item) => {
    return item.imageSrc === btnClicked.parentElement.querySelector('.cart-image').src;
  });
  
  // если товар был найден, удаляем его из куки
  if (index !== -1) {
    cartItems.splice(index, 1);
    setCookie('cartItems', JSON.stringify(cartItems), 7);
  }
}

// update quantity input
var quantityInput = document.getElementsByClassName('product-quantity')[0];

for (var i = 0; i < quantityInput; i++){
input = quantityInput[i]
input.addEventListener('change', changeQuantity)
}

function changeQuantity(event) {
var input = event.target
if (isNaN(input.value) || input.value <= 0){
input.value = 1
}
updateCartPrice()
}
// end of update quantity input

// update total price
function updateCartPrice() {
var total = 0
for (var i = 0; i < productRow.length; i += 2) {
cartRow = productRow[i]
var priceElement = cartRow.getElementsByClassName('cart-price')[0]
var quantityElement = cartRow.getElementsByClassName('product-quantity')[0]
var price = parseFloat(priceElement.innerText.replace('$', ''))
var quantity = quantityElement.value
total = total + (price * quantity )

}
document.getElementsByClassName('total-price')[0].innerText =  '$' + total

document.getElementsByClassName('cart-quantity')[0].textContent = i /= 2
}
// end of update total price

// purchase items
const purchaseBtn = document.querySelector('.purchase-btn');

const closeCartModal = document.querySelector('.cart-modal');

purchaseBtn.addEventListener('click', purchaseBtnClicked)

function purchaseBtnClicked () {
  window.location.href = './card/card.html';
  cartModalOverlay.style.transform= 'translateX(-100%)';
  var cartItems = document.getElementsByClassName('product-rows')[0];
  while (cartItems.hasChildNodes()) {
    cartItems.removeChild(cartItems.firstChild);
  }
  updateCartPrice();
}

function goBack() {
  window.history.back();
}
'use strict';

const modal = document.querySelector('.modal');
const overlay = document.querySelector('.overlay');
const btnCloseModal = document.querySelector('.close-modal');
const btnsOpenModal = document.querySelectorAll('.show-modal');

const openModal = function () {
    modal.classList.remove('hidden');
    overlay.classList.remove('hidden');
}

const closeModal = () => {
    modal.classList.add('hidden');
    overlay.classList.add('hidden');
}

for (let i = 0; i < btnsOpenModal.length; i++) {
    btnsOpenModal[i].addEventListener('click', openModal);
}

btnCloseModal.addEventListener('click',closeModal);
overlay.addEventListener('click',closeModal);

document.addEventListener('keydown', function(evt) {
    console.log(evt.key);

    if (evt.key === 'Escape' && !modal.classList.contains('hidden')) {
            closeModal();
        }
});

// Сортировка по возрастанию/по убыванию/по рейтингу
document.querySelector("button#sort-asc").onclick = function () {
  mySort("data-price");
};
document.querySelector("button#sort-desc").onclick = function () {
  mySortDesc("data-price");
};
document.querySelector("button#sort-rating").onclick = function () {
  mySortDesc("data-rating");
};

// По возрастанию
function mySort(sortType) {
  let nav = document.querySelector(".products-container");
  for (let i = 0; i < nav.children.length; i++) {
    for (let j = i; j < nav.children.length; j++) {
      if (
        +nav.children[i].getAttribute(sortType) >
        +nav.children[j].getAttribute(sortType)
      ) {
        replacedNode = nav.replaceChild(nav.children[j], nav.children[i]);
        insertAfter(replacedNode, nav.children[i]);
      }
    }
  }
}

// По убыванию и рейтингу
function mySortDesc(sortType) {
  let nav = document.querySelector(".products-container");
  for (let i = 0; i < nav.children.length; i++) {
    for (let j = i; j < nav.children.length; j++) {
      if (
        +nav.children[i].getAttribute(sortType) <
        +nav.children[j].getAttribute(sortType)
      ) {
        replacedNode = nav.replaceChild(nav.children[j], nav.children[i]);
        insertAfter(replacedNode, nav.children[i]);
      }
    }
  }
}

function insertAfter(elem, refElem) {
  return refElem.parentNode.insertBefore(elem, refElem.nextSibling);
}
