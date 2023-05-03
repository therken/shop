var menuIcon = document.querySelector('.menu-icon-box');
var navigation = document.querySelector('nav');
var submenu = document.querySelector('.submenu');

menuIcon.onclick = function(e) {
	e.preventDefault();
	this.classList.toggle('open');
	submenu.classList.toggle('open');
	navigation.classList.toggle('dark');
}

const products = document.querySelectorAll('.product');

products.forEach(product => {
  const price = product.getAttribute('data-price');
  const description = product.querySelector('.description').textContent;
  const priceInput = document.querySelector('input[name="price"]');
  const descInput = document.querySelector('input[name="desc"]');

  product.addEventListener('click', () => {
	priceInput.value = price;
	descInput.value = description;
  });
});
const checkoutForm = document.getElementById('checkout-form');

const cartRows = document.querySelectorAll('.product-row');
const priceInput = document.querySelector('input[name="price"]');
const descriptionInput = document.querySelector('input[name="description"]');

let totalPrice = 0;
let cartItems = '';

cartRows.forEach(row => {
  const imageSrc = row.querySelector('.cart-image').getAttribute('src');
  const description = row.querySelector('.description').textContent;
  const price = row.querySelector('.cart-price').textContent;
  const quantity = row.querySelector('.product-quantity').value;
  const size = row.querySelector('.size').value;

  const itemPrice = parseFloat(price.replace('$', ''));
  const itemTotalPrice = itemPrice * quantity;

  totalPrice += itemTotalPrice;

  cartItems += `${description} (${quantity} x ${price} - Размер: ${size})\n`;

});

priceInput.value = totalPrice.toFixed(2);
descriptionInput.value = cartItems;

checkoutForm.submit();
