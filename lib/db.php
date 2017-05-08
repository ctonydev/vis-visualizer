<?php

include_once("config.php");
include_once("ip.php");
include_once("domain/domain.php");

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

function getNetworks() {
	$conn = getDBConnection();

	// entire list
	$networks = array();

	// grab all networks
	$sql = "SELECT * FROM networks";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
	    // output data of each row
	    while($row = $result->fetch_assoc()) {
	    	$o = new Network;
	    	$o->network = $row["network"];
	    	$o->mask = $row["mask"];
	    	array_push($networks, $o);
	    }
	} else {
	    echo "0 results";
	}
	
	closeDBConnection($conn);

	return $networks;
}

function getNetworkIps() {
	$networks = getNetworks();

	$ips = array();
    foreach($networks as $network) {
		$net = $network->network."/".$network->mask;
    	$list = iplist($net);
    	$ips = array_merge($ips, $list);

       // echo $network->network;
    }
    return $ips;
}

function saveIp($ip){
	$conn = getDBConnection();

	$sql = "REPLACE into ip values('".$ip->ip."',now(),'".$ip->ping."','".$ip->laststatus."','".$ip->hostname."')";
//	echo $sql."\n";
	if ($conn->query($sql) != TRUE) {
	    echo "Error: " . $sql . "<br>" . $conn->error;
	}	
	$result = $conn->query($sql);
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
	    	array_push($ips, $o);
	    }
	} else {
	    echo "0 results";
	}
	
	closeDBConnection($conn);

	return $ips;
}

?>