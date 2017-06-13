function addToCart(id){
		
     $.getJSON('//ip-api.com/json?callback=?',
      function(json) {

      	$.ajax({

      		url:"/ajax/add_cart.php",
      		method:"post",
      		dataType :'json',
      		data :{

      			productID : id,
      			ip : json.query,
      			country : json.country,
      			country_code : json.countryCode,
      			city : json.city,
      			isp : json.isp,
      			org : json.org,
      			as_name : json.as,
      			zip : json.zip,
      			timezone : json.timezone,
      			region : json.region,
      			region_name : json.regionName,
      			lat : json.lat,
      			lon : json.lon,
      			
      		},
      		success:function(data){

      			if (data.exists==true) {
      				
      				$('#cart_item').html("Cart("+data.items+")");
      			
      			}else if (data.error==true) {

      				alert("Item already Cart.");
      			}
      		},
      		error:function(){

      			alert("error");
      		}
      	});
      }
    );
}

function updateCart(id,qty){

     $.getJSON('//ip-api.com/json?callback=?',
      function(json) {

      	$.ajax({

      		url:"/ajax/update_cart.php",
      		method:"post",
      		dataType :'json',
      		data :{

      			productID : id,
      			ip : json.query,
      			quantity:qty
      			
      		},
      		success:function(data){

      			if (data.exists==true) {
    
      				$('#cart_item').html("Cart("+data.items+")");
      			}else if (data.error==true) {

      				alert("Item already Cart.");
      			}
      		},
      		error:function(){

      			alert("error");
      		}
      	});
      }
    );
}

function removeCart(id){

     $.getJSON('//ip-api.com/json?callback=?',
      function(json) {

      	$.ajax({

      		url:"/ajax/remove_cart.php",
      		method:"post",
      		dataType :'json',
      		data :{

      			productID : id,
      			ip : json.query
      			
      		},
      		success:function(data){

      			if (data.exists==true) {
    
      				$('#cart_item').html("Cart("+data.items+")");
      			}else if (data.error==true) {

      				alert("Item already Cart.");
      			}
      		},
      		error:function(){

      			alert("error");
      		}
      	});
      }
    );
}

(function($){
	'use strict';
	var items = $('.display_product').length;
	var priceTotal=0;
	for (var i =1;i<=items;i++) {
		
		var singlePrice = $('#single_price'+i).val();
		var qty = $('#qty_input'+i).val();
		//alert(qty);
		var totalPrice = parseFloat(singlePrice*qty);
		$('.single_total'+i).find('strong').html("Tk. "+totalPrice);
		$('.single_total'+i).find('input').val(totalPrice);
		$('.price_total'+i).find('strong').html("Tk. "+totalPrice);
		
	}
	for (var i=1;i<=items;i++) {
		var itemValue = $('.cart_shoping').find('#total_price'+i).val();
		priceTotal +=parseFloat(itemValue);
		$('.price_total').find('strong').html("Tk. "+ priceTotal);
	}	
	
	$.fn.controllQuantity = function(options){

		var defaultSettings = {};
		var settings       = $.extend({}, defaultSettings, options);

		var $this = $(this);
		var $quantity = $this.find('.quantity');
		var $plusButton = $quantity.find(".plus");
		var $minusButton = $quantity.find(".minus");
		var $quantityInput = $quantity.find("input");
		var $price = $this.find(".price");
		var $total = $this.find(".total");
		var $removeButton = $this.find(".remove");
		var newItems,
			singlePrice,
			totalPrice;

		$quantityInput.on("keyup",function(){
			var items =1;
				items = $quantityInput.val();
			if (items>=1) {

				singlePrice = $price.find('.single_price').val();
				totalPrice = parseFloat(singlePrice * items);
				$total.find('.total_price').val(totalPrice);
				$total.find('strong').html("Tk. "+totalPrice);
			}

			$quantityInput.val(items);
			updateTotalCartAmount();
			updateCart(settings.id,items);
		});

		$plusButton.on("click",function(){
			var items = $quantityInput.val();
			newItems = parseInt(items)+1;
			$quantityInput.val(newItems);
			if (newItems>=1) {

				singlePrice = $price.find('.single_price').val();
				totalPrice = parseFloat(singlePrice * newItems);
				$total.find('.total_price').val(totalPrice);
				$total.find('strong').html("Tk. "+totalPrice);
			}
			updateTotalCartAmount();
			updateCart(settings.id,newItems);
		});

		$minusButton.on("click",function(){
			var items = $quantityInput.val();
			newItems = parseInt(items)-1;
			if (newItems<1) {

				newItems = 1;
			}
			$quantityInput.val(newItems);
			if (newItems>=1) {

				singlePrice = $price.find('.single_price').val();
				totalPrice = parseFloat(singlePrice * newItems);
				$total.find('.total_price').val(totalPrice);
				$total.find('strong').html("Tk. "+totalPrice);
			}

			updateTotalCartAmount();
			updateCart(settings.id,newItems);
		});

		$removeButton.on("click",function(){

			$this.fadeOut('slow', function(){
				
				$this.remove();
				updateTotalCartAmount();
				removeCart(settings.id);
			});	
		});

		function updateTotalCartAmount(){

			/*Total Cart Amount*/
			var items = $('.cart_shoping').find('.total_price').length;
				var totalPrice=0;
				for(var i=0;i<items;i++){

					var itemValue = $('.cart_shoping').find('.total_price').eq(i).val();
					totalPrice +=parseFloat(itemValue);
				}

				$('.price_total').find('strong').html("Tk. "+totalPrice);
			}
		
	};
})(jQuery);

$.getJSON('//ip-api.com/json?callback=?',
	function(json) {
		/*
		var cartLink = $('a#cart_link').attr("href");
		var checkoutLink = $('a#checkout_link').attr("href");
		$('a#cart_link').attr("href", cartLink+json.query);
		$('a#checkout_link').attr("href", checkoutLink+json.query);
*/		
		$.ajax({

			url:"/ajax/get_cart.php",
			method:"post",
			dataType:'json',
			data:{

				ip:json.query
			},
			success:function(data){

				if (data.exists==true) {
					
					$('#cart_item').html("Cart("+data.items+")");
				}
			}
	});
});