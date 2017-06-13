// Create Function to control Tune Image Head button

    $(document).ready(function(){

        $("#head_btn").click(function(){

            $(".user_img_body").toggle();
            $(".navarrow").html("&#9662")

            return false;
        });
    });

    // Create Function to control Tab
    function displayOne(thechosenone,btn) {


        // Create Function to Style Button Such As active and deactive

        $(".style_btn").each(function(index) {
            
            // Check button id and given parameter value is equal or not 
              if ($(this).attr("id") == btn) {
                    
                // if true then work this section
                   $(this).addClass("active");
              }
              else {
                  $(this).removeClass("active");
              }
         });
        // Select each box item
         $('.sub_buttons').each(function(index) {
            var button = document.getElementById(btn);
            $(button).addClass("active");
                // Check box id and given parameter value is equal or not 
              if ($(this).attr("id") == thechosenone) {
                    
                // if true then work this section
                   $(this).slideDown("slow");
                   $(this).addClass("p_active");
              }
              else {
                   $(this).slideUp(0);
              }
         });
    }