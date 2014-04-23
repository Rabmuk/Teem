
	<!--//--><![CDATA[//><!--
	$(document).ready(function() {
		$('form#contact-us').submit(function() {
			$('form#contact-us .error').remove();
			var hasError = false;
			$('.requiredField').each(function() {
				if($(this).hasClass('name')) {
					if($.trim($(this).val()) == '') {
						$(this).parent().append('<span class="error"><br>Please enter your name.</span>');
						$(this).addClass('inputError');
						hasError = true;
					}
				} 
				if($(this).hasClass('email')) {
					if($.trim($(this).val()) == '') {
						$(this).parent().append('<span class="error"><br>Please enter your email address.</span>');
						$(this).addClass('inputError');
						hasError = true;
					}
				}
				if($(this).hasClass('message')) {
					if($.trim($(this).val()) == '') {
						$(this).parent().append('<span class="error"><br>Please enter your message.</span><br><br>');
						$(this).addClass('inputError');
						hasError = true;
					}
				}
				if($(this).hasClass('email')) {
					var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
					if(!emailReg.test($.trim($(this).val()))) {
						var labelText = $(this).prev('label').text();
						$(this).parent().append('<span class="error"><br>Please enter a valid email address.</span>');
						$(this).addClass('inputError');
						hasError = true;
					}
				}
			});
			if(!hasError) {
				var formInput = $(this).serialize();
				$.post($(this).attr('action'),formInput, function(data){
					$('form#contact-us').slideUp("fast", function() {				   
						$(this).before('<p class="tick" style="color:#197b5e;">Thank you! Your message has been sent. </p>');
					});
				});
			}
			
			return false;	
		});
	});
	//-->!]]>