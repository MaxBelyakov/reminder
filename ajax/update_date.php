<?php
session_start();
include '../config.php';

if (isset($_POST['id'])) {
  $contact_id = $_POST['id'];

  // Protection
  $contact_id = protect_var($contact_id, true); 
    
  // Connect to DB
  $db = new DB_variable;
    
  $result = 'UPDATE `'.$db->db_data_table.'` SET `last_date` = NOW() WHERE `id`='.$contact_id.'';
  $result = $db->send_query($result);
}
  
?>