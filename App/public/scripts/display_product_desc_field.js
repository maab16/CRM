
	  $(window).load(function(){
	  		var optionValue = $('#category').val();

	  		if (optionValue=="") {

	  			$('.description').css("display","none");
	  		}
		  $("#category").on('change',function(){

		    var category = $(this).val();
		    var div = $(".description", $(this));
		    $(".description").not(div).css("display","none");
		   
		    switch(category){

		    	case "Desktop":
		    	case "desktop":
		        	$("#"+category+"_description").css("display", "block");
		    		break;
		    	case "Notebook":
		    	case "notebook":

		        	$("#"+category+"_description").css("display", "block");
		    		break;

		    	default :
		    		$('.description').css("display","none");
		    		break;
		    }
	});
});