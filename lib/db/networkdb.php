<?php

include_once("lib/ip.php");

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

?>