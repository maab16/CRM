(function($){
	'use strict';
	$.fn.animateImage = function(options){

		var deafults = {

			animationType : {

				slideLeft : false,
				slideLeftToRight : false,
				slideRightToLeft : false,
				slideRight : false,
				slideUp : false,
				slideDown : false,
				slideDownLeft : false,
				slideDownRight : false,
				fontAnimation : false,
				leftToRight : false,
				ID1: "#id_1",
				ID2: "#id_2",
				ID3: "#id_3"

			},
			fontAnimationSize : "1.5em",
			scrollTopView : false,
			scrollBottomView : false,
			left:0,
			center:0,
			right:0,
			top:0,
			bottom:0
		}

		var settings = $.extend({},deafults,options);

		var $this = $(this);

		if (settings.scrollBottomView===true) {

			$(window).scroll(function () {

				if (isScrolledIntoView($this)) {

					if ($this.hasClass("animation")) {

						if (settings.animationType.slideLeft === true) {

							slideLeft($this.find("#slideLeft"),settings.left);
						}

						if (settings.animationType.slideRight === true) {

							slideRight($this.find("#slideRight"),settings.right);
						}

						if (settings.animationType.slideUp === true) {

							slideUp($this.find("#slideUp"),settings.center);
						}

						if (settings.animationType.slideDown === true) {

							slideDown($this.find("#slideDown"),settings.center);
						}

						if (settings.animationType.slideLeftToRight === true) {

							slideLeftToRight($this.find("#slideLeftToRight"),"60%");
						}

						if (settings.animationType.slideRightToLeft === true) {

							slideRightToLeft($this.find("#slideRightToLeft"),"50%");
						}

						if (settings.animationType.leftToRight === true) {

							slideLeft(settings.animationType.ID1,settings.left);
							slideLeft(settings.animationType.ID2,settings.center);
							slideLeft(settings.animationType.ID3,settings.right);
						}

						if (settings.animationType.slideDownLeft === true) {

							slideDownLeft($("#slideDownLeft"),settings.left);
						}

						if (settings.animationType.slideDownRight === true) {

							slideDownRight($("#slideDownRight"),settings.right);
						}

						if (settings.animationType.fontAnimation === true) {

							fontAnimation($this.find("#fontAnimation"),settings.fontAnimationSize);
						}
						
						$this.removeClass("animation");
					}
				}
			});

			}else if(settings.scrollTopView===true){

				$(window).scroll(function () {

					if (getElementView($this)) {

						if ($this.hasClass("animation")) {

							if (settings.animationType.slideLeft === true) {

								slideLeft($this.find("#slideLeft"),settings.left);
							}

							if (settings.animationType.slideRight === true) {

								slideRight($this.find("#slideRight"),settings.right);
							}

							if (settings.animationType.slideUp === true) {

								slideUp($this.find("#slideUp"),settings.center);
							}

							if (settings.animationType.slideDown === true) {

								slideDown($this.find("#slideDown"),settings.center);
							}

							if (settings.animationType.slideLeftToRight === true) {

								slideLeftToRight($this.find("#slideLeftToRight"),"60%");
							}

							if (settings.animationType.slideRightToLeft === true) {

								slideRightToLeft($this.find("#slideRightToLeft"),"50%");
							}

							if (settings.animationType.leftToRight === true) {

								slideLeft(settings.animationType.ID1,settings.left);
								slideLeft(settings.animationType.ID2,settings.center);
								slideLeft(settings.animationType.ID3,settings.right);
							}

							if (settings.animationType.slideDownLeft === true) {

								slideDownLeft($("#slideDownLeft"),settings.left);
							}

							if (settings.animationType.slideDownRight === true) {

								slideDownRight($("#slideDownRight"),settings.right);
							}

							if (settings.animationType.fontAnimation === true) {

								fontAnimation($this.find("#fontAnimation"),settings.fontAnimationSize);
							}
							
							$this.removeClass("animation");
						}
					}
				});
			}else{

				if ($this.hasClass("animation")) {

					if (settings.animationType.slideLeft === true) {

						slideLeft($this.find("#slideLeft"),settings.left);
					}

					if (settings.animationType.slideRight === true) {

						slideRight($this.find("#slideRight"),settings.right);
					}

					if (settings.animationType.slideUp === true) {

						slideUp($this.find("#slideUp"),settings.center);
					}

					if (settings.animationType.slideDown === true) {

						slideDown($this.find("#slideDown"),settings.center);
					}

					if (settings.animationType.slideLeftToRight === true) {

						slideLeftToRight($this.find("#slideLeftToRight"),"60%");
					}

					if (settings.animationType.slideRightToLeft === true) {

						slideRightToLeft($this.find("#slideRightToLeft"),"50%");
					}

					if (settings.animationType.leftToRight === true) {

						slideLeft(settings.animationType.ID1,settings.left);
						slideLeft(settings.animationType.ID2,settings.center);
						slideLeft(settings.animationType.ID3,settings.right);
					}

					if (settings.animationType.slideDownLeft === true) {

						slideDownLeft($("#slideDownLeft"),settings.left);
					}

					if (settings.animationType.slideDownRight === true) {

						slideDownRight($("#slideDownRight"),settings.right);
					}

					if (settings.animationType.fontAnimation === true) {

						fontAnimation($this.find("#fontAnimation"),settings.fontAnimationSize);
					}
						
					//$this.removeClass("animation");
				}

				
			}

		/* Document and Element Related Functions*/

		function getElementView(element){

			var win = $(window);
    
		    var viewport = {
		        top : win.scrollTop(),
		        left : win.scrollLeft()
		    };
		    viewport.right = viewport.left + win.width();
		    viewport.bottom = viewport.top + win.height();
		    
		    var bounds = element.offset();
		    bounds.right = bounds.left + element.outerWidth();
		    bounds.bottom = bounds.top + element.outerHeight();
		    return (!(viewport.right < bounds.left || viewport.left > bounds.right || viewport.bottom < bounds.top || viewport.top > bounds.bottom));

			
		}

		function getElementTop(element){

			return $(element).offset().top;
		}

		function getDocumentTop(){

			return $(window).scrollTop();
		}
			
		function getDocumentBottom(){

			var docViewTop = getDocumentTop();
			var docViewBottom = docViewTop + $(window).height();

			return docViewBottom;
		}

			

		function getElementBottom(element){

			var $element = $(element);
			var elementTop = getElementTop(element)
			var elementBottom = elementTop + $element.height();

			return elementBottom;
		}

		function isScrolledIntoView(element){
				
			var docViewTop = getDocumentTop();

			var elementTop = getElementTop(element);

			var docViewBottom = getDocumentBottom();

			var elementBottom = getElementBottom(element);

			return ((elementBottom <= docViewBottom) && (elementTop >= docViewTop));
		}

		/* Animation Rotation Functions */

		function slideLeft(element,left_align=0,duration=1500){

			$(element).css("position","absolute").animate({left:-1000},0);
			$(element).css("display","block").animate({left:left_align},duration);
		}

		function slideRight(element,right_align=0,duration=1500){

			$(element).css("position","absolute").animate({right:-1000},0);
			$(element).css("display","block").animate({right:right_align},duration);

		}

		function slideUp(element,left_align=0,duration=1500){

			$(element).css("position","absolute").animate({bottom:-800},0);
			$(element).css("display","block").animate({left:left_align,top:0},duration);

		}

		function slideDown(element,left_align=0,duration=1500){

			$(element).css("position","absolute").animate({top:-1000},0);
			$(element).css("display","block").animate({left:left_align,top:0},duration);
		}

		function slideLeftToRight(element,left_align=0,duration=1500){

			$(element).css("position","absolute").animate({left:-1000},0);
			$(element).css("display","block").animate({left:left_align},duration);
		}

		function slideRightToLeft(element,left_align=0,duration=1500){

			$(element).css("position","absolute").animate({right:-1000},0);
			$(element).css("display","block").animate({right:left_align},duration);
		}

		function slideDownLeft(element,left_align=0,duration=2000){

			$(element).css("position","absolute").animate({top:-1500},0);
			$(element).css("display","block").animate({left:left_align,top:0},duration);
		}

		function slideDownRight(element,right_align=0,duration=2000){

			$(element).css("position","absolute").animate({top:-1500},0);
			$(element).css("display","block").animate({right:right_align,top:0},duration);
		}

		function flexiLeftSlide(element,align="left:0px",duration=1500){

			$(element).css("position","absolute").animate({left:-1000},0);
			$(element).css("display","block").animate({align},duration);
		}

		function fontAnimation(element,fontAnimationSize="1.5em",duration=1500){
			$(element).css("position","absolute").animate({top:0,fontSize:0},0);
			$(element).css("display","block").animate({fontSize: fontAnimationSize,padding:5},2000);
			
		}
	};
})(jQuery);