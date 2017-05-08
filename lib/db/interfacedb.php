<?php


function eraseInterfaces($host) {
	$conn = getDBConnection();

	$sql = "delete from interface where host='".$host->sysname."'";
//	echo $sql."\n";
	if ($conn->query($sql) != TRUE) {
	    echo "Error: " . $sql . "<br>" . $conn->error;
	}	
	$result = $conn->query($sql);
	closeDBConnection($conn);	
}


?>