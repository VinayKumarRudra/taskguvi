$(document).ready(function() {

	// process the form
	$('form').submit(function(event) {

		$('.form-group').removeClass('has-error'); // remove the error class
		$('.help-block').remove(); // remove the error text

		// get the form data
		// there are many ways to get this data using jQuery (you can use the class or id also)
		var formData = {
			'email' 			: $('input[name=email]').val(),
			'password' 			: $('input[name=password]').val()
		};

		// process the form
		$.ajax({
			type 		: 'POST', // define the type of HTTP verb we want to use (POST for our form)
			url 		: 'process.php', // the url where we want to POST
			data 		: formData, // our data object
			dataType 	: 'json', // what type of data do we expect back from the server
			encode 		: true
		})
			// using the done promise callback
			.done(function(data) {

				// log data to the console so we can see
				console.log(data); 

				// here we will handle errors and validation messages
				if ( ! data.success) {
					console.log("here")
					// handle errors for name ---------------
					if (data.errors.email) {
						$('#email-group').addClass('has-error'); // add the error class to show red input
						$('#email-group').append('<div class="help-block">' + data.errors.email + '</div>'); // add the actual error message under our input
					}

					// handle errors for email ---------------
					if (data.errors.conn) {
						$('form').addClass('has-error'); // add the error class to show red input
						$('form').append('<div class=" alert help-block">' + data.errors.conn + '</div>'); // add the actual error message under our input
					}
					
					if (data.errors.cred) {
						console.log("SDSDSDSD")
						$('form').addClass('has-error'); // add the error class to show red input
						$('form').append('<div class="alert help-block">' + data.errors.cred + '</div>'); // add the actual error message under our input
					}
					// handle errors for superhero alias ---------------
					if (data.errors.password) {
						$('#password-group').addClass('has-error'); // add the error class to show red input
						$('#password-group').append('<div class="help-block">' + data.errors.superheroAlias + '</div>'); // add the actual error message under our input
					}

				} else {console.log("SUCCESS");

					// ALL GOOD! just show the success message!
					$('form').append('<div class="alert alert-success">' + data.message + '</div>');
					
					window.location = 'profile.php';
					// usually after form submission, you'll want to redirect
					// window.location = '/thank-you'; // redirect a user to another page

				}
			})

			// using the fail promise callback
			.fail(function(data) {
				console.log("FAILED")
				// show any errors
				// best to remove for production
				console.log(data);
			});

		// stop the form from submitting the normal way and refreshing the page
		event.preventDefault();
	});

});