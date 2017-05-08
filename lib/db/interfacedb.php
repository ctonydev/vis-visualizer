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

function saveInterface($ip){
	$conn = getDBConnection();

	$stmt = $conn->prepare("REPLACE into interface (host, name, ip, mask) VALUES (?,?,?,?)");
	$stmt->bind_param("ssss", $ip->host, $ip->name, $ip->ip, $ip->mask);
	$stmt->execute();
	echo ( $stmt->error);
	closeDBConnection($conn);
} 

?>