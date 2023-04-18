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
// open cart modal
const cart = document.querySelector('#cart');
const cartModalOverlay = document.querySelector('.cart-modal-overlay');

cart.addEventListener('click', () => {
if (cartModalOverlay.style.transform === 'translateX(-200%)'){
cartModalOverlay.style.transform = 'translateX(0)';
} else {
cartModalOverlay.style.transform = 'translateX(-200%)';
}
})
// end of open cart modal

// close cart modal
const closeBtn = document.querySelector ('#close-btn');

closeBtn.addEventListener('click', () => {
cartModalOverlay.style.transform = 'translateX(-200%)';
});

cartModalOverlay.addEventListener('click', (e) => {
if (e.target.classList.contains('cart-modal-overlay')){
cartModalOverlay.style.transform = 'translateX(-200%)'
}
})
// end of close cart modal

// add products to cart
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
<input class="size" type="number" placeholder="size"  min="38" max="48">
<i id="close-btn" class="fa fa-times"></i>
</div>

`
productRow.innerHTML = cartRowItems;
productRows.append(productRow);
productRow.getElementsByClassName('fa fa-times')[0].addEventListener('click', removeItem)
productRow.getElementsByClassName('product-quantity')[0].addEventListener('change', changeQuantity)
updateCartPrice()
}
// end of add products to cart

// Remove products from cart
const removeBtn = document.getElementsByClassName('fa fa-times');
for (var i = 0; i < removeBtn.length; i++) {
button = removeBtn[i]
button.addEventListener('click', removeItem)
}

function removeItem (event) {
btnClicked = event.target
btnClicked.parentElement.parentElement.remove()
updateCartPrice()
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
var nonLinearSlider = document.getElementById('nonlinear');

noUiSlider.create(nonLinearSlider, {
connect: true,
behaviour: 'tap',
start: [ 10, 300 ],
range: {
min: 10,
max: 300
}
});

var nodes = [
document.getElementById('lower-value'), // 0
document.getElementById('upper-value')  // 1
];

// Display the slider value and how far the handle moved
// from the left edge of the slider.
nonLinearSlider.noUiSlider.on('update', function ( values, handle, unencoded, isTap, positions ) {
nodes[handle].innerHTML = values[handle];  
verifyBoxes(values)
});


function verifyBoxes(v) {
var boxesArr = [].slice.call(document.querySelectorAll(".product")).map(function(item){
return item
});

for (var i =0; i < boxesArr.length; i++) {
var box = boxesArr[i]
var price = box.querySelector('.product-price').textContent
var priceNumb = parseInt(price)
var vMin = v[0]
var vMax = v[1]

if (priceNumb > vMax || priceNumb < vMin  ) {
box.classList.add('-close') 
} else {
box.classList.remove('-close')
}
}
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
