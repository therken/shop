sessionStorage.setItem('added', 0);
  var status_add = sessionStorage.getItem('added');
$('.list_add-review-cta').click(function(){
  sessionStorage.setItem('added', 1);
  console.log(status_add);
  let username = document.getElementById("review-username").value;
   let message = document.getElementById("rewiew_message").value;
  let userimage = $("#review-userimage").val();
  $('.main_reviews-container').append('<div class="border py-3 my-2 border-dark rounded faq_inner container"><div class="accordian-link d-flex align-items-center pointer py-2"><img src="https://source.unsplash.com/random/2200x1200/?person" class="img-fluid user_image"><h3 class="reveiew_user_name ps-3">'+username+'</h3></div><p class="review_answer">'+message+'</p></div>');
  clearvalues();
});
  function clearvalues(){
  document.getElementById("review-username").value = "";
document.getElementById("rewiew_message").value = "";
 $('#review-userimage').val('');
  }
  function goBack() {
    window.history.back();
  }