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
