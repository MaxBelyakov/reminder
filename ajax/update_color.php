<?php
include '../config.php';

if (isset($_POST['id']) && isset($_POST['red'])) {

	$id = $_POST['id'];
	$red = $_POST['red'];

	$red = protect_var($red);
	
	// Connect to DB
	$db = new DB_variable;
	
	$result = 'UPDATE `'.$db->db_data_table.'` SET `red_val`='.$red.' WHERE `id`='.$id;
	$result = $db->send_query($result);
	
	// Get current field color
	$result = "SELECT `last_date` FROM `".$db->db_data_table."` WHERE `id`=".$id;
	$result = $db->send_query($result);
	$result_row = mysql_fetch_assoc($result);
	$diff_date_array = diff_the_date($result_row['last_date']);
	$contact_container = get_color($diff_date_array[0]['in_days'],$red);
	
	echo $contact_container;
	
}
	
?>