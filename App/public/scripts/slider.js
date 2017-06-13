sliderInt =1;
sliderNext =2;
$(document).ready(function(){

	$("#inner_div>img#1").fadeIn("slow");
		autoLoadSlider();
		/*Show Image List */
		showNextPrev();

});

// Display Auto Slide Images
function autoLoadSlider(){

	count = $("#inner_div>img").size();

		loop = setInterval(function(){

			if(sliderNext>count) {

				sliderNext =1;
				sliderInt = 1;
			}

			$("#inner_div>img").fadeOut("slow");
			$("#inner_div>img#"+sliderNext).fadeIn("fast");

			/*Show Under line*/
			currentActiveImage(sliderNext);
			
			sliderInt = sliderNext;
			sliderNext = sliderInt+1;

		},5000);

}

// When Click Left Arrow Then Display Previous Image
function prev(){

	newSlider = sliderInt-1;
	if(newSlider<1){

		newSlider =$("#inner_div>img").size();
	}
	currentActiveImage(newSlider);
	slideShow(newSlider);
}

// When Click Right Arrow Then Display Next Image
function next(){

	newSlider = sliderInt+1;
	if (newSlider>$("#inner_div>img").size()) {

		newSlider = 1;
	}
	currentActiveImage(newSlider);
	
	slideShow(newSlider);
}

// Stop Image autoload

function stopLoop(){

	window.clearInterval(loop);

}

// Show Image when Click a link

function slideShow(id){

	stopLoop();

	if(id>count) {

		id =1;
	}else if(id<1){

		id = count;
	}

	$("#inner_div>img").fadeOut(300);
	$("#inner_div>img#"+id).fadeIn(300);

	// Active Current Image List Bacground and remove inActive Image Lists Background
	currentActiveImage(id);

	sliderInt = id;
	sliderNext = id+1;
	
	autoLoadSlider();

}

// when mouse hover over Slider image then stop image auto load

$("#inner_div>img").hover(

	function(){

		stopLoop();
	},
	function(){

		autoLoadSlider();
	}
);

/*Slider Images Link List*/

function showNextPrev(){

	link = "";

	countImg = $("#inner_div>img").size();
	
	for (var i =1; i<=countImg;  i++) {

		if (i==1) {

			link +="<a class='activeLink' id="+i+" href='#"+i+"' onclick='slideShow("+i+"); return false;'><span class='btn btn-default btn-circle'></span></a>";
		}else{
			link +="<a id="+i+" href='#"+i+"' onclick='slideShow("+i+"); return false;'><span class='btn btn-default btn-circle'></span></a>";
		}	
		
	}

	$("#linkList").html(link);

}

/*Apply Background Upon Current Active Link*/

function currentActiveImage(id){

	activeImage = $("#linkList>#"+id);
	activeImage.addClass("activeLink");
	$("div#linkList>a").not(activeImage).removeClass("activeLink");
}
