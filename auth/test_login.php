<?php
session_start();
include '../config.php';

if (isset($_POST['login']) && isset($_POST['password'])) {
	$login = $_POST['login'];
	$password = md5($_POST['password']);
	if (empty($login) || empty($password)) {
		unset($login);
		unset($password);
		exit ("Empty fields");
	}

	// Protect login and password
	$login = protect_var($login, true);
	$password = protect_var($password);

	// Connect to DB
	$db = new DB_variable;
	$result = $db->send_query('SELECT * FROM `'.$db->db_users_table.'` WHERE login="'.$login.'" LIMIT 1');

	$myrow = mysql_fetch_array($result);

	if (empty($myrow['password'])) {
	  exit ("Login or password is incorrect");
	} else {
		if ($myrow['password'] == $password) {
			// Fill the session
			$_SESSION['login']=$myrow['login']; 
			$_SESSION['id']=$myrow['id'];
			exit ('Success');
	  } else {
	    exit ("Login or password is incorrect");
	  }
	}
} else {
	exit ("Login error");
}

?>