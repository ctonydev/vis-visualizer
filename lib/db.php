<?php

include_once("config.php");
include_once("domain/domain.php");
include_once("lib/db/ipdb.php");
include_once("lib/db/networkdb.php");
include_once("lib/db/hostdb.php");

function getDBConnection() {
	global $db_servername;
	global $db_username;
	global $db_password;
	global $db_dbname;

	$conn = new mysqli($db_servername, $db_username, $db_password, $db_dbname);
	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}
	return $conn;	
} 

function closeDBConnection($conn) {
	$conn->close();
}

?>