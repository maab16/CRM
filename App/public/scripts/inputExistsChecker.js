$.fn.inputExistsChecker = function(){

	return this.each(function(){

		var interval;
		
		$(this).on('keyup',function(){

			var self = $(this),
				selfType=self.data('type'),
				selfValue,
				feedback = $('.check-exists-feedback[data-type=' + selfType + ']');

			if (interval===undefined) {

				interval = setInterval(function(){

					if (selfValue !== self.val()) {

						selfValue = self.val();

						if (selfValue.length>1) {

							$.ajax({

								url 		: '/exists.php',
								type 		: 'get',
								dataType 	: 'json',
								data 		: {

										type :selfType,
										value:selfValue
								},

								success	: function(data){

									if (data.exists !== undefined) {

										if (data.exists===true) {

											if (selfType=='username') {

												$('.username').removeClass('available').addClass('exists');
												feedback.text('Sorry!Already Taken.Please Choose Another One.');

											}else if(selfType=='email'){
												$('.email').removeClass('available').addClass('exists');
												feedback.text('Sorry!Already Taken.Please Choose Another One.');

											}else if (selfType=='password'){

												if (!selfValue.match(/^.(?=.{6,})(?=.[a-z])(?=.[A-Z])(?=.[\d\W]).*$/)) {

													if (!selfValue.match(/(?=.*[A-Z])/)) {

														$('.password').removeClass('available').addClass('exists');

														feedback.text("Password must be contain at least one Capital Letter!");

													}else if (!selfValue.match(/(?=.*[\d])/)) {

														$('.password').removeClass('available').addClass('exists');

														feedback.text("Password must be contain at least one number!");
													}else if (!selfValue.match(/(?=.*[a-z])/)) {

														$('.password').removeClass('available').addClass('exists');

														feedback.text("Password must be contain at least one small Letter!");
													}else if (!selfValue.match(/(?=.*[\W])/)) {

														$('.password').removeClass('available').addClass('exists');

														feedback.text("Password must be contain at least one special Charecter!");
													}else if (!selfValue.match(/(?=.{8,})/)) {

														$('.password').removeClass('available').addClass('exists');

														feedback.text("PASSWORD MUST BE CONTAIN AT LEAST 8 CHARECTERS");
													}
												}


												//feedback.text('Password Must be atleast 1 Capital Charecter , 1 letter and 1 number');

											}else if (selfType=='re_password') {

												$('.re_password').removeClass('available').addClass('exists');

												feedback.text("PASSWORD Doesn't match!");

											}

											
										}else if (data.exists===false){

											if (selfType=='username') {

												if (selfValue.length<5) {

													$('.username').removeClass('available').addClass('exists');

													feedback.text('Username must be Contain Atleast 5 Charecters!');

												}else{

													$('.username').removeClass('exists').addClass('available');

													feedback.text('That is Available!');

												}

											}else if(selfType=='email'){

												var username = $('input[name="username"]').val();
												
												var validaor = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
												
												$('.email').removeClass('available').addClass('exists');
												
												if(selfValue.length<4){
													
													feedback.text("Email name must be 4 charecter");
												
												}else if (selfValue==username) {
													
													feedback.text("Email name doesn't same username");
												
												}else if(!validaor.test(selfValue)){
													
													feedback.text("Email not valid. Must be contain @ and . ");
												
												}else{
												
													$('.email').removeClass('exists').addClass('available');
												
													feedback.text('That is Available');	
												}
											
											}else if(selfType=='password'){

												$('.password').removeClass('exists').addClass('available');

												feedback.text('PASSWORD STRONG.');
												
											}else if (selfType=='re_password') {

												$('.re_password').removeClass('exists').addClass('available');

												feedback.text('PASSWORD MATCHED.');
											}

											
										}
									}
									
								},
								error	: function(){

									console.log('file not exists');

								}
							});
						}
					}
				},500);
			}
		});
	});
};