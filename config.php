<?php

//Paths
include 'reminder_func.php';

$LOGIN_AUTHORIZED_PATH      = 'auth/authorized.tpl';
$LOGIN_UNAUTHORIZED_PATH    = 'auth/unauthorized.tpl';
$AUTH_PAGE_PATH             = 'auth/registration.php';
$LOGIN_JS_PATH              = 'js/login.js';
$LIST_JS_PATH               = 'js/list.js';

$TITLE                      = 'Reminder';

$WEB_SITE                   = '';

/**************************************** DB class ********************************************/
class DB_variable {
	private $connection;
	private $db_host;
	private $db_database;
	private $db_user;
	private $db_password;
	
	// Construction function which is run when the object is created
	function __construct() { 

		$this->db_host = '';
		$this->db_user = '';
		$this->db_password = '';
		$this->db_database = '';
		$this->db_users_table = 'reminder_users';
		$this->db_data_table = 'reminder_contacts';

		$this->connection = mysql_connect($this->db_host, $this->db_user, $this->db_password) or die("A MySQL error has occurred.");
		$db_select = mysql_select_db($this->db_database, $this->connection);
		$db_charset = mysql_set_charset('utf8');

	}

	function send_query($query) {
		$query_data = mysql_query($query) or die("A MySQL error has occurred.");
		return $query_data;
	}
	
	function num_rows($array) {
		return mysql_num_rows($array);
	}
	
	function fetch_field($query, $field_name) {
	  $query_data = $this->send_query($query);
	  $field_data = mysql_fetch_assoc($query_data);
	  return $field_data[$field_name];
	}
}
/**************************************** /DB class ********************************************/

?>