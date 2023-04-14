document.getElementById('range-picker').addEventListener('click', function(e) {
  var sizeList = document.getElementById('range-picker').children;
  for (var i = 0; i <= sizeList.length - 1; i++) {
    console.log(sizeList[i].classList);
    if (sizeList[i].classList.contains('active')) {
      sizeList[i].classList.remove('active');
    }
  }
  e.target.classList.add('active');
})

function goBack() {
  window.history.back();
}
const buyButton = document.querySelector('.buy');

buyButton.addEventListener('click', function() {
  window.location.href = '../../../card/card.html';
});
