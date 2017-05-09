<?php
function saveHost($host){
	$conn = getDBConnection();

	$stmt = $conn->prepare("REPLACE into host (sysname, sysdesc, lastseen) VALUES (?,?,now())");
	$stmt->bind_param("ss", $host->sysname, $host->sysdesc);
	$stmt->execute();

	closeDBConnection($conn);
} 

function getAllHosts() {
	$conn = getDBConnection();

	// entire list
	$hosts = array();

	// grab all networks
	$sql = "SELECT * FROM host";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
	    // output data of each row
	    while($row = $result->fetch_assoc()) {
	    	$o = new Host;
	    	$o->sysname = $row["sysname"];
	    	$o->sysdesc = $row["sysdesc"];
	    	array_push($hosts, $o);
	    }
	} else {
	    echo "0 results";
	}
	closeDBConnection($conn);
	return $hosts;
}

/*
* look up a hostname by the ip, using the interface table
*/

function getHostNameByIP($ip){
	$conn = getDBConnection();

	// query the interface table
	$sql = "SELECT host FROM interface where ip='".$ip->ip."'";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
		$r = $result->fetch_assoc();
//		var_dump($r["host"]);
		return $r["host"];
	} else {
		return false;
	}
	closeDBConnection($conn);
	return $hosts;
}

?>