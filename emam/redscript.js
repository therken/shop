$(document).ready(function() {
    $('textarea').on('input', function () {
      this.style.height = 'auto';
      this.style.height = (this.scrollHeight) + 'px';
    });
  });
  $(document).ready(function() {
    $('#profile-photo').change(function() {
      var reader = new FileReader();
      reader.onload = function(e) {
        $('label[for="profile-photo"] img').attr('src', e.target.result);
      };
      reader.readAsDataURL(this.files[0]);
    });
  });
  $(document).ready(function(){
    $('form').submit(function(event){
        event.preventDefault();
        var formData = new FormData($('form')[0]);
        $.ajax({
            url: 'profile.php',
            type: 'POST',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function(response){
                alert(response);
            },
            complete: function() {
            }
        });
    });
});
window.onload = function() {
  document.getElementById("form").reset();
}
