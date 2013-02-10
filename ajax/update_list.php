<?php
include '../config.php';

if (isset($_POST['id']) && isset($_POST['name']) && isset($_POST['position'])) {

	$id = $_POST['id'];
	$name = $_POST['name'];
	$position = $_POST['position'];	
	
	$name = protect_var($name);
	
	// Connect to DB
	$db = new DB_variable;
	
	$result = 'UPDATE `'.$db->db_data_table.'` SET `name`="'.$name.'",`position`='.$position.' WHERE `id`='.$id.'';
	$result = $db->send_query($result);
	
}
	
?>