<?php
include '../config.php';

if (isset($_POST['ready_login']) && isset($_POST['ready_password']) && isset($_POST['ready_email'])) {
	$login = $_POST['ready_login'];
	$password = $_POST['ready_password'];
	$email = $_POST['ready_email'];
	
	// Protection
	$login = protect_var($login, true);
	$password = protect_var($password, true);
	$email = protect_var($email, true);
	$password = md5($password);

	// Connect to DB
	$db = new DB_variable;
	
	$result = $db->send_query('INSERT INTO `'.$db->db_users_table.'` (login,password,email) VALUES ("'.$login.'","'.$password.'","'.$email.'")');
	
	// Return to main page
	echo $WEB_SITE;
}
	
?>
	