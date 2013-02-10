<?php
session_start();
include '../config.php';

if (isset($_POST['contact_id']) && isset($_SESSION['id'])) {
	
	$delete_contact = $_POST['contact_id'];
	
	$delete_contact = protect_var($delete_contact, true); 
				
	// Connect to DB
	$db = new DB_variable;
		
	$result = "DELETE FROM `".$db->db_data_table."` WHERE `id`='".$delete_contact."' AND `user_id`='".$_SESSION['id']."' LIMIT 1";
	$result = $db->send_query($result);
}
?>