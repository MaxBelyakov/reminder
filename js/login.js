var $login_ready = 0;
var $pass_ready = 0;
var $email_ready = 0;

// Auth paths
NEW_USER_FILE            = '../auth/new_user.php';
CHECK_REG_DATA_FILE      = '../auth/check_reg_data.php';

// Different paths
TEST_LOGIN_FILE          = 'auth/test_login.php';
LOGOUT_FILE              = 'auth/logout.php';


$(document).ready(function() {

	// Hide check buttons on registration page
	$('.yes_field').hide();
	$('.no_field').hide();

	// Check entered keys on registration page
	// Login test
	$('#registration_login').keyup(function() {
		$('.yes_field').hide();
		$('.no_field').hide();
		$('#registration_login').css('border-color','initial');

		// RegExp login test
		var p = /^[a-zA-Z0-9]{4,15}$/;
		var str = $(this).attr('value');

		if (str.match(p)) {
			// Maybe the login already exists
			$.post(CHECK_REG_DATA_FILE, {
				check_login: str
			}, function(data) {
				// Don't exist and RegExp is correct
				if (data == 1) {
					$('#login_yes_button').show();
					$('.no_field').hide();
					$login_ready = 1;
				} else {
					// Already exists
					$('#login_no_button').show();
					$('#login_duplicate').show();
					$('#login_yes_button').hide();
					$login_ready = 0;	
				}
			});
		} else {
			// Error in RegExp test
			$('#login_no_button').show();
			$('#login_error').show();
			$('#login_yes_button').hide();
			$login_ready = 0;
		}

	});

	// Password test
	$('#registration_password').keyup(function() {
		$('#registration_password').css('border-color','initial');
		var p = /^[a-zA-Z0-9]{6,15}$/;
		var str = $(this).attr('value');
		if (str.match(p)) {
			$('#password_yes_button').show();
			$('#password_no_button').hide();
			$pass_ready = 1;
		} else {
			$('#password_no_button').show();
			$('#password_yes_button').hide();
			$pass_ready = 0;
		}
	});
	// E-mail test
	$('#registration_email').keyup(function() {
		$('#registration_email').css('border-color','initial');
		var p = /^[a-z0-9_\.\-]+@([a-z0-9\-]+\.)+[a-z]{2,6}$/i;
		var str = $(this).attr('value');
		if (str.match(p)) {
			$('#email_yes_button').show();
			$('#email_no_button').hide();
			$email_ready = 1;
		} else {
			$('#email_no_button').show();
			$('#email_yes_button').hide();
			$email_ready = 0;
		}
	});


	// Button actions
	$('#logout_button').click(function() {
		logout_submit();
	});
	$('#login_button').click(function() {
		login_submit();
	});
	$('#register_button').click(function() {
		register();
	});

	// Listening enter press onto login and password fields
	$('#login_field, #password_field').keypress(function(e) {
		if (e.keyCode == 13) {
			login_submit();
		}
	});

});

function register() {
	// Check all data again
	var $ready = 1;
	
	if ($login_ready != 1) {
		$('#registration_login').css('border','2px inset red');
		$ready = 0;
	}
	if ($pass_ready != 1) {
		$('#registration_password').css('border','2px inset red');
		$ready = 0;
	}
	if ($email_ready != 1) {
		$('#registration_email').css('border','2px inset red');
		$ready = 0;
	}
	
	// Post the result
	if ($ready == 1) {
		$.post(NEW_USER_FILE, {
			ready_login: $('#registration_login').attr('value'),
			ready_password: $('#registration_password').attr('value'),
			ready_email: $('#registration_email').attr('value')
		}, function(data) {
			alert('Welcome');
			window.location = data;
		});
	}
}

function login_submit() {
	$.post(TEST_LOGIN_FILE, {
		login: $('#login_field').attr('value'), 
		password: $('#password_field').attr('value')
	}, function(data) {
		if (data == 'Success') {
			location.reload();
		} else {
			alert(data);
		}
	});
}

function logout_submit() {
	$.post(LOGOUT_FILE, function(data) {
		location.reload();
	});
}