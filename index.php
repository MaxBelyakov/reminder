<?php 
	include 'config.php';
	session_start();
	$user_login = $_SESSION['login'];
	$user_id = $_SESSION['id'];
?>

<!DOCTYPE html>

<html>

<head>
	<title><?php echo $TITLE; ?></title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" type="text/css" href="css/reminder.css">
	<meta charset="utf-8">
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.8.3.js"></script>
	<script type="text/javascript" src="http://code.jquery.com/ui/1.9.2/jquery-ui.js"></script>
	<script type="text/javascript" src="<?php echo $LOGIN_JS_PATH; ?>"></script>
	<script type="text/javascript" src="<?php echo $LIST_JS_PATH; ?>"></script>
</head>

<body>
	
<div class="bar">
	<div class="search_form">
		<a href='<?php echo $WEB_SITE; ?>' class="main_title"><?php echo $TITLE; ?></a>
		<input type="text" name="search" autocomplete="off" id="search_box" maxlength="400" autofocus>
	</div>
</div>

<?php
// Login form
if (empty($user_login) or empty($user_id)) {
	$user_panel .= file_get_contents($LOGIN_UNAUTHORIZED_PATH);
	$user_panel = str_replace("%registration_page%", $AUTH_PAGE_PATH, $user_panel);
} else {
	$user_panel .= file_get_contents($LOGIN_AUTHORIZED_PATH);
	$user_panel = str_replace("%user_login%", $user_login, $user_panel);
}

// Draw data
echo $user_panel;

// Active zone and <add new> field
if (!empty($user_login) and !empty($user_id)) {
?>
	<div class='container'>
		<div class='answers_box' id='op_element'>
			<div class='contacts_title'>
				<span class='contacts_title_name'>
					Name
				</span>
				<span class='contacts_title_last_contact'>
					Last contact
				</span>
			</div>
		</div>
		<hr class='answers_box'>
		<ul id='sortable'></ul>
		<hr class='answers_box'>
	</div>
	<div class='addnew'>
		<div id='addnew_form'>
			<input type='text' class='answers_box_addnew' maxlength='28'>
			<input type='submit' id='add_new_button' value='Add new' class='button'>
		</div>
	</div>
<?php } ?>

</body>
</html>