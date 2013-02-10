<?php 
	$STYLE_CSS_PATH = '../css/style.css';
	$REMINDER_CSS_PATH = '../css/reminder.css';
	$LOGIN_JS_PATH = '../js/login.js';
	$YES_PIC_PATH = '../pics/yes.png';
	$NO_PIC_PATH = '../pics/no.png';
?>

<!DOCTYPE html>

<html>

<head>
	<title>Registration page</title>
	<link rel="stylesheet" type="text/css" href="<?php echo $STYLE_CSS_PATH; ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo $REMINDER_CSS_PATH; ?>">
	<meta charset="utf-8">
	
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.8.3.js"></script>
	<script type="text/javascript" src="http://code.jquery.com/ui/1.9.2/jquery-ui.js"></script>
	<script type="text/javascript" src="<?php echo $LOGIN_JS_PATH; ?>"></script>
</head>

<body>

<div class="bar">
	<div class="search_form"><a href="" class="main_title">Registration Page</a></div>
</div>

<br><br><br>

<div class="registration_box">
	<form>
		<p>
			Login:<br>
			<input id="registration_login" name="login" type="text" size="20" maxlength="15" autocomplete="off">
			<img id="login_yes_button" class="yes_field" src="<?php echo $YES_PIC_PATH; ?>"></img>
			<img id="login_no_button" class="no_field" src="<?php echo $NO_PIC_PATH; ?>"></img>
			<span id="login_error" class="no_field"><br>Login must consist of numbers or letters only and have length from 4 to 15.</span>
			<span id="login_duplicate" class="no_field"><br>This login is already exists.</span>
		</p>
		<p>
			Password:<br>
			<input id="registration_password" name="password" type="password" size="20" maxlength="15" autocomplete="off">
			<img id="password_yes_button" class="yes_field" src="<?php echo $YES_PIC_PATH; ?>"></img>
			<span id="password_no_button" class="no_field"><img src="<?php echo $NO_PIC_PATH; ?>"></img>
				<br>
				Password must consist of numbers or letters only and have length from 6 to 15.
			</span>
		</p>
		<p>
			E-mail:<br>
			<input id="registration_email" name="email" type="text" size="50" maxlength="30" autocomplete="off">
			<img id="email_yes_button" class="yes_field" src="<?php echo $YES_PIC_PATH; ?>"></img>
			<span id="email_no_button" class="no_field"><img src="<?php echo $NO_PIC_PATH; ?>"></img></span>
		</p>
		<p>
			<input type="button" value="Register" class="button" id="register_button">
		</p>
	</form>
</div>

</body>
</html>