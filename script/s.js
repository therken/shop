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