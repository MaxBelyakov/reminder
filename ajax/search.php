<?php
include '../config.php';
$EDIT_IMG_PATH = 'pics/edit.png';
$DELETE_IMG_PATH = 'pics/no.png';
$UPDATE_IMG_PATH = 'pics/update.png';

if (isset($_POST['search_term'])) {
	$search = $_POST['search_term'];
	$order = $_POST['order'];
	$results = search_results_question_using_like_method($search, $order);
		
	if (!empty($results)) {
		foreach($results as $result) {
		
			// Fill the array with <string>,<years>,<months>,<days> by <last_date>
			$diff_date_array = diff_the_date($result['last_date']);
				
			// Get current field color
			$contact_container = get_color($diff_date_array[0]['in_days'],$result['red_value']);
			
			// Print contact line
			$obj_string = $diff_date_array[0]['date_diff'];
			echo '<li><div class="'.$contact_container.'" id="contact_container_'.$result['id'].'">
					<div class="name_container">
						<div class="contact_name" id="'.$result['id'].'">'.$result['name'].'</div>
						<div class="contact_edit"><img src="'.$EDIT_IMG_PATH.'"></img></div>
						<div class="contact_delete"><img src="'.$DELETE_IMG_PATH.'"></img></div>
					</div>
					<div class="contact_date_diff"><div class="contact_update"><img src="'.$UPDATE_IMG_PATH.'"></img></div>'.$obj_string.'</div>
				  </div></li>
			';
		}
	}
}
?>