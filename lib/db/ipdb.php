<?php

function saveIp($ip){
	$conn = getDBConnection();

	$stmt = $conn->prepare("REPLACE into ip (ip, ping, laststatus, hostname, lastseen) values (?,?,?,?,now())");
	$stmt->bind_param("sdis", $ip->ip,$ip->ping,$ip->laststatus,$ip->hostname);
	$stmt->execute();

	closeDBConnection($conn);
} 

function getIps() {
	$conn = getDBConnection();

	// entire list
	$ips = array();

	// grab all networks
	$sql = "SELECT * FROM ip";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
	    // output data of each row
	    while($row = $result->fetch_assoc()) {
	    	$o = new Ip;
	    	$o->ip = $row["ip"];
	    	$o->lastseen = $row["lastseen"];
	    	$o->ping = $row["ping"];
	    	$o->laststatus = $row["laststatus"];
	    	$o->hostname = $row["hostname"];

	    	array_push($ips, $o);
	    }
	} else {
	    echo "0 results";
	}
	
	closeDBConnection($conn);

	return $ips;
}

function getIp($ip) {
	$conn = getDBConnection();

	$sql = "SELECT * FROM ip where ip='".$ip."'";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
		$row = $result->fetch_assoc();
		$o = new Ip;
    	$o->ip = $row["ip"];
    	$o->lastseen = $row["lastseen"];
    	$o->ping = $row["ping"];
    	$o->laststatus = $row["laststatus"];
    	$o->hostname = $row["hostname"];

		return $o;
	} else {
		return false;
	}
	
	closeDBConnection($conn);
}
?>