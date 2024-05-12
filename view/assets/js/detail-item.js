
$(document).ready(function() {

  $('.detail-page__color-choose input').on('click', function() {
      var shoesColor = $(this).attr('data-image');

      $('.active').removeClass('active');
      $('.detail-page__left-column img[data-image = ' + shoesColor + ']').addClass('active');
      $(this).addClass('active');
  });

});

var modal = document.getElementById('item-modal');
        // Get the button that opens the modal
var btn = document.getElementById("item-btn");
        // When the user clicks the button, open the modal 
        btn.onclick = function () {
            modal.style.display = "block";
        }
        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function (event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }