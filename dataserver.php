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

//$nets = getDistictNetworks();
//var_dump($nets);
$routers = getRouterHosts();
//var_dump($routers);
$ips = getIps();

/*
* create nodes for every router
*/
foreach($routers as $host) {
	$node = new Node;
	// build the node
	$node->label = $host->sysname;
	$node->id =  $host->sysname;
	$node->title =  $host->sysname;
	$node->color = "rgb(229,164,255)";
	$node->size = 5.0;
	
	$attributes = new Attributes;
	$attributes->Weight=1.0;
	$node->attributes = $attributes;

	// add the node
	array_push($data->nodes, $node);
}

/*
* create nodes for every non-router ip
*/
foreach($ips as $ip) {
	/*
	* check if the ip is attached to a router
	*/
	if (false==isRouterIp($ip)){
		/*
		* ip is not on a router draw the node
		*/
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
}

/*
* walk the ips again, this time creating edges to appropriate routers
*/
foreach($ips as $ip) {
	/*
	* check if the ip is attached to a router
	*/
	if (false==isRouterIp($ip)){
		/*
		* ip is not on a router draw the node
		*/
		$rtr_hostname = getRouterForIp($ip);

		$edge = new Edge;
		$edge->id=uniqid();
		$edge->from = $rtr_hostname;
		$edge->to = $ip->ip;
		$edge->color = "rgb(229,164,67)";
		$edge->size = 5.0;

		$attributes = new Attributes;
		$attributes->Weight=1.0;
		$edge->attributes = $attributes;

		array_push($data->edges, $edge);
	}
}

$json = json_encode($data);
echo $json;

?>
