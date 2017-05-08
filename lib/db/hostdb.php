<?php
function saveHost($host){
	$conn = getDBConnection();

	$sql = "REPLACE into host values('".$host->sysname."','".$host->sysdesc."',now())";
//	echo $sql."\n";
	if ($conn->query($sql) != TRUE) {
	    echo "Error: " . $sql . "<br>" . $conn->error;
	}	
	closeDBConnection($conn);
} 

?>