<?php
include '../config.php';

if (isset($_POST['check_login'])) {
	$check_login = $_POST['check_login'];
		
	// Protect check_login
	$check_login = protect_var($check_login, true);

	// Connect to DB
	$db = new DB_variable;

	$result = $db->fetch_field('SELECT * FROM `'.$db->db_users_table.'` WHERE login="'.$check_login.'" LIMIT 1', 'login');
	
	if (empty($result)) {
		echo 1;
	} else {
		echo 0;
	}
}
?>