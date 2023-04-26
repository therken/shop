sessionStorage.setItem('added', 0);
  var status_add = sessionStorage.getItem('added');
$('.send').click(function(){
  sessionStorage.setItem('added', 1);
  console.log(status_add);
  let username = document.getElementById("review-username").value;
   let message = document.getElementById("rewiew_message").value;
  let userimage = $("#review-userimage").val();
  $('.main_reviews-container').append('<div class="border py-3 my-2 border-dark rounded faq_inner container"><div class="accordian-link d-flex align-items-center pointer py-2"><img src="https://steamcdn-a.akamaihd.net/steamcommunity/public/images/avatars/b5/b5bd56c1aa4644a474a2e4972be27ef9e82e517e_full.jpg" class="img-fluid user_image"><h3 class="reveiew_user_name ps-3">'+username+'</h3></div><p class="review_answer">'+message+'</p></div>');
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
