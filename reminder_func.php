<?php
session_start();

function search_results_question_using_like_method($keyword, $order) {

	// Connect to DB
	$db = new DB_variable;

	$keyword = protect_var($keyword, true);
	$results = "SELECT * FROM `".$db->db_data_table."` WHERE (`name` LIKE '%".$keyword."%') AND (`user_id`=".$_SESSION['id'].") ORDER BY `".$order."`";
	
	$results_num = ($results = $db->send_query($results)) ? $db->num_rows($results) : 0;
	if ($results_num === 0) {
		return false;
	} else {
		while ($results_row = mysql_fetch_assoc($results)) {
			$returned_results[] = array (
								'id' => $results_row['id'],
								'name' => $results_row['name'],
								'last_date' => $results_row['last_date'],
								'yellow_value' => $results_row['yellow_val'],
								'red_value' => $results_row['red_val']
			);
		}
		return $returned_results;
	}
}


function diff_the_date($date) {
	$str = '';
	$result = array();
	$date1 = $date;
	$date2 = date("Y-m-d");

	$diff = abs(strtotime($date2) - strtotime($date1));
	
	$in_days = floor($diff / (60*60*24));

	$years = floor($diff / (365*60*60*24));
	$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
	$days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

	$str .= ($years != 0) ? ($years.' years ') : '';
	$str .= ($months != 0) ? ($months.' months ') : '';  	
	$str .= ($days != 0) ? (($days == 1) ? ($days.' day ago') : ($days.' days ago')) : 'less than 1 day ago';  
	
	$result[] = array (
					'date_diff' => $str, 
					'years' => $years, 
					'months' => $months, 
					'days' => $days,
					'in_days' => $in_days
	);
	
	return $result;
}


function get_color($days, $red) {
	if ($red == 0) {
		$result = 'contact_container_green';
	} else if ($days > $red) {
		$result = 'contact_container_red';
	} else if ($days > intval($red / 2)) {
		$result = 'contact_container_yellow';
	} else {
		$result = 'contact_container_green';
	}
	return $result;
}


function protect_var($var, $sql=false) {
	// Connect to DB
	$db = new DB_variable;

  $var = htmlentities($var, ENT_QUOTES, 'UTF-8');
  if(get_magic_quotes_gpc ()) {
    $var = stripslashes ($var);
  }

  if ($sql) {
    $var = mysql_real_escape_string($var);
  }

  $var = strip_tags($var);
  return $var;
}
?>