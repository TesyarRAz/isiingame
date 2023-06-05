document.addEventListener('DOMContentLoaded', function() {
    var imagePreviews = document.querySelectorAll('[data-toggle=image-preview]');
  
    imagePreviews.forEach(function(imagePreview) {
      var source = imagePreview.querySelector('input[data-source]');
      var target = imagePreview.querySelector('img[data-target]');
  
      target.addEventListener('click', function() {
        source.click();
      });
  
      source.addEventListener('change', function(e) {
        var reader = new FileReader();
  
        reader.onload = function(e) {
          target.setAttribute('src', e.target.result);
        };
  
        reader.readAsDataURL(e.target.files[0]);
      });
    });
  });