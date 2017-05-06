<?php
include("config.php");
include("ip.php");

$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// entire list
$ips = array();

// grab all networks
$sql = "SELECT * FROM networks";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {

    	$network = $row["network"];
    	$mask = $row["mask"];

    	$net = $network."/".$mask;
    	echo $net."\r\n";

    	$list = iplist($net);
    	array_merge($ips, $list);
    }
} else {
    echo "0 results";
}
$conn->close();

var_dump($ips);

foreach($ips as $ip) {
	echo $ip;
}

?>

