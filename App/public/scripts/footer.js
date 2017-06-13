
//console.log($(window).width());

if ($(window).width()>970) {

			$(".header_top").animateImage({

				animationType :{

					slideRight : true,
					fontAnimation : true,
					fontAnimationSize : "24px"
					
				}
			});

			if ($(".new_products").length > 0) {

				$(".new_products").animateImage({

					animationType :{

						slideLeft : true,
						slideUp : true,
						slideRight : true
					},
					scrollTopView : true,
					center : "33.33%"
				});
			}
			

			$(".footer_top").animateImage({

				animationType :{

					slideRightToLeft : true,
					slideLeftToRight : true
				},
				scrollBottomView : true
			});

			$(".footer_middle").animateImage({

				animationType :{

					leftToRight : true,
					ID1:"#mfl",
					ID2:"#mfc",
					ID3:"#mfr"
				},
				scrollBottomView:true,
				center : "24.99%",
				right : "74.99%"
			});

			$(".footer_bottom").animateImage({

				animationType :{

					slideDownLeft : true,
					slideDownRight : true
				},
				scrollTopView : true
				
			});

			$('.carousel').carousel({
			   interval: 2000
			  });
			  if ($(window).width()<970 && $(window).width()>767) {

			  	$(".magnify").zoomImg({
				  	zoomDivPosition : "overLap"
				  });
			  }else if($(window).width()>=970){
			  	$(".magnify").zoomImg();
			  }
			  
			  // initialize with defaults
			$("#input-id").rating();

			// with plugin options (do not attach the CSS class "rating" to your input if using this approach)
			$("#input-id").rating({'size':'xs'});

		}else{
			$('.header_top .navbar-collapse li').addClass("cart_collapse");
			$('.slider_div').addClass("no-display");
			$('.slider_carousel').addClass("no-display");
			$('.new_products_div').addClass("no-display");
			$('.price-range').addClass("no-display");
			$('.search-by-brand').addClass("no-display");
			$('.search-by-category').addClass("no-display");
			$('.flexi_search').addClass("no-display");
			$('.fixed_search').removeClass("animateProperty");
			$('.fixed_search').addClass("display");
			$('.header_top div').find("*").removeClass("no-display");
			$('.footer_top div').find("*").removeClass("no-display");
			$('.footer_middle div').find("*").removeClass("no-display");
			$('.footer_bottom div').find("*").removeClass("no-display");
		}
		// Call cart Items for change qty
		var items = $('.display_product').length;
		for (var i=1;i<=items;i++) {
		   	var product_id = $('#productID_'+i).val();
			$('.product_'+i).controllQuantity({id:product_id});
		}