var menuIcon = document.querySelector('.menu-icon-box');
var navigation = document.querySelector('nav');
var submenu = document.querySelector('.submenu');

menuIcon.onclick = function(e) {
	e.preventDefault();
	this.classList.toggle('open');
	submenu.classList.toggle('open');
	navigation.classList.toggle('dark');
}


