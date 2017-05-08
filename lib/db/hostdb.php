<?php
function saveHost($host){
	$conn = getDBConnection();

	$stmt = $conn->prepare("REPLACE into host (sysname, sysdesc, lastseen) VALUES (?,?,now())");
	$stmt->bind_param("ss", $host->sysname, $host->sysdesc);
	$stmt->execute();

	closeDBConnection($conn);
} 

?>