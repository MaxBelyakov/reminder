<?php
session_start();
include '../config.php';

if (isset($_POST['new_contact']) && isset($_POST['position'])) {
	$new_contact = $_POST['new_contact'];
	$position = $_POST['position'];

	// Protection
	$new_contact = protect_var($new_contact, true); 
	$position = protect_var($position, true);
		
	// Connect to DB
	$db = new DB_variable;
		
	$result = "INSERT INTO `".$db->db_data_table."` (`name`,`last_date`,`user_id`,`position`,`red_val`) VALUES ('".$new_contact."',NOW(),".$_SESSION['id'].",".$position.",30)";
	$result = $db->send_query($result);
}
	
?>