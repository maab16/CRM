$(document).ready(function(){

        $('.drop_div').each(function() {
          var dropdown = $(this);

          $(".dropdown-item", dropdown).click(function(e) {
            e.preventDefault();
            //select dropdown container and store div variable
            var div = $("div.dropdown-container", dropdown);
            // trigger selected div
            div.toggle("slow");
            // Change Down Arrow To Upper Arrow
            $('span.navarrow').html("&#9652");
              
            // Not Change another button arrow that not selected
            $('span.navarrow').not( $('span.navarrow', dropdown)).html("&#9662");
        
            // Hide Another div element that not selected
            $("div.dropdown-container").not(div).hide("slow");

            return false;
          });

      });   
         
    });