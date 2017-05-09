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

function getAllInterfaces() {
	$conn = getDBConnection();

	// entire list
	$interfaces = array();

	// grab all networks
	$sql = "SELECT * FROM interface";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
	    // output data of each row
	    while($row = $result->fetch_assoc()) {
	    	$o = new Iface;
	    	$o->id = $row["id"];
	    	$o->host = $row["host"];
	    	$o->name = $row["name"];
	    	$o->ip = $row["ip"];
	    	$o->mask = $row["mask"];	    		    		    	
	    	$o->index = $row["index"];	    		    		    
	    	array_push($interfaces, $o);
	    }
	} else {
	    echo "0 results";
	}
	closeDBConnection($conn);
	return $interfaces;
}

function getDistictNetworks() {
	$conn = getDBConnection();

	// entire list
	$nets = array();

	// grab all networks
	$sql = "SELECT distinct ip, mask FROM interface";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
	    // output data of each row
	    while($row = $result->fetch_assoc()) {
	    	$nets[$row["ip"]]= $row["mask"];
	    }
	} else {
	    echo "0 results";
	}
	closeDBConnection($conn);
	return $nets;
}

?>