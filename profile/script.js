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
    function goBack() {
        window.history.back();
      }