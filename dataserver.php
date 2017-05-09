<?php   

include_once("config.php");
include_once("domain/domain.php");
include_once("lib/analysis.php");

$data = new graphvis;

// Create connection
$conn = new mysqli($db_servername, $db_username, $db_password, $db_dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$nets = getDistictNetworks();
//var_dump($nets);

/*
* grab all ips
*/
$ips = getIps();
//var_dump($ips);
for ($i=0; $i<count($ips);$i++){
	$ip =$ips[$i];

	$node = new Node;
	// build the node
	$node->label =  getNodeName($ip);
	$node->id =  $ip->ip;
	$node->title =  $ip->ip;
	$node->color = "rgb(229,164,67)";
	$node->size = 5.0;
	
	$attributes = new Attributes;
	$attributes->Weight=1.0;
	$node->attributes = $attributes;

	// add the node
	array_push($data->nodes, $node);
}

$json = json_encode($data);

echo $json;

?>
