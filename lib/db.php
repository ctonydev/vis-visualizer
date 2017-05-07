<?php

include("config.php");
include("ip.php");
include("domain/domain.php");

function getDBConnection() {
	global $servername;
	global $username;
	global $password;
	global $dbname;

	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}
	return $conn;	
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
	$conn->close();

	return $networks;
}

function getNetworkIps() {
	$networks = getNetworks();

	$ips = array();
    foreach($networks as $network) {
		$net = $network->network."/".$network->mask;
    	$list = iplist($net);
    	$ips = array_merge($ips, $list);

        echo $network->network;
    }
    return $ips;
}

?>