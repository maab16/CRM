var validNavigation = false;
function removeCurrentUserCart() {

  $.getJSON('//ip-api.com/json?callback=?',
      function(json) {

        $.ajax({

          url:"/ajax/remove_cart_history.php",
          method:"post",
          dataType :'json',
          data :{
            ip : json.query
           
          },
          success:function(data){

            if (data.exists==true) {
              
              $('#cart_item').html("Cart("+data.items+")");
              return true;
            }
          },
          error:function(){

            return false;
          }
        });
      }
    );
}
 
function detectBrowserClose() {

  window.addEventListener("beforeunload", function (e) {

    if (!validNavigation) {
      removeCurrentUserCart();
      //var confirmationMessage = removeCurrentUserCart();

      //e.returnValue = confirmationMessage;     // Gecko, Trident, Chrome 34+
                     // Gecko, WebKit, Chrome <34
      }
    
  });

  $("a").on("click", function() {
    validNavigation = true;
  });

  $(document).on('keydown', function(e) {
    if ((e.which || e.keyCode)==116){
      validNavigation = true;
      
    }
  });

}