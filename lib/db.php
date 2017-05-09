	<?php

include_once("config.php");
include_once("lib/domain/domain.php");
include_once("lib/db/ipdb.php");
include_once("lib/db/networkdb.php");
include_once("lib/db/hostdb.php");
include_once("lib/db/interfacedb.php");

function getDBConnection() {
	global $db;

	$conn = new mysqli($db["servername"], $db["username"], $db["password"], $db["dbname"]);
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