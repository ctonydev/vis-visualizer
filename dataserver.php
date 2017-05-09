<?php   

include_once("config.php");
include_once("lib/domain/domain.php");
include_once("lib/analysis.php");

$data = new graphvis;

// Create connection
$conn = new mysqli($db["servername"], $db["username"], $db["password"], $db["dbname"]);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

//$nets = getDistictNetworks();
//var_dump($nets);
$routers = getRouterHosts();
//var_dump($routers);
$ips = getIps();
$all_interfaces = getAllInterfaces();

/*
* create nodes for every router
*/
foreach($routers as $host) {
	$node = new Node;
	// build the node
	$node->label = $host->sysname;
	$node->id =  $host->sysname;
	$node->title =  $host->sysname;
	$node->color = $colors["up-router"];
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
		if (1==$ip->laststatus){
			$node->color = $colors["up-host"];
		} else {
			$node->color = $colors["down-host"];
		} 
		$node->size = 5.0;
		
		$attributes = new Attributes;
		$attributes->Weight=1.0;
		$node->attributes = $attributes;

		// add the node
		array_push($data->nodes, $node);
	}
}

/*
* walk the ips again, this time creating edges from non-routers to appropriate routers
*/
foreach($ips as $ip) {
	/*
	* check if the ip is attached to a router
	*/
	if (false==isRouterIp($ip)){
		/*
		* get the default router for the ip
		*/
		$rtr_hostname = getRouterForIp($ip);

		$edge = new Edge;
		$edge->id=uniqid();
		$edge->from = $rtr_hostname;
		$edge->to = $ip->ip;
		$edge->color = $colors["up-edge"];
		$edge->size = 5.0;

		$attributes = new Attributes;
		$attributes->Weight=1.0;
		$edge->attributes = $attributes;

		array_push($data->edges, $edge);
	}
}

/*
* walk the router ips, this time creating edges from routers to appropriate routers
*/
foreach($all_interfaces as $interface) {
	/*
	* get the router name for the ip
	*/
	$interface_hostname =$interface->host;

	/*
	* get ip object for ip address
	*/
	$ipObj = getIp($interface->ip);
	/*
	* get the default router for the ip
	*/
	$rtr_hostname = getRouterForIp($ipObj);
	
	//echo $interface->ip." : ".$interface_hostname." ".$rtr_hostname."<br>\n";
	if (false!=$rtr_hostname){
		if ($rtr_hostname!=$interface_hostname){
	//	var_dump($interface->ip);

			$edge = new Edge;
			$edge->id=uniqid();
			$edge->from = $interface_hostname;
			$edge->to = $rtr_hostname;
			$edge->color = $colors["up-edge"];
			$edge->size = 5.0;

			$attributes = new Attributes;
			$attributes->Weight=1.0;
			$edge->attributes = $attributes;

			array_push($data->edges, $edge);
		}	
	}
}

$json = json_encode($data);
echo $json;

?>
