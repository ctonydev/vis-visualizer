<?php   

include_once("config.php");
include_once("lib/domain/domain.php");
include_once("lib/analysis.php");

$data = new graphvis;

$routers = getRouterHosts();
$ips = getIps();
$all_interfaces = getAllInterfaces();

/*
* create nodes for every router
*/
foreach($routers as $host) {
	$node = new Node;
	// build the node
	$node->label = shortname($host->sysname);
	$node->id =  $host->sysname;
	$node->title =  $host->sysname;
	$node->color = $colors["up-router"];
	$node->size = $node_conf["size"];
	$node->font = $node_conf["font"];
	$node->mass = $node_conf["router-mass"];	

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
		$node->label = getNodeLabel($ip);
		$node->id =  $ip->ip;
		$node->title = getNodeTitle($ip);
		if (1==$ip->laststatus){
			$node->color = $colors["up-host"];
		} else {
			$node->color = $colors["down-host"];
		} 
		$node->size = $node_conf["size"];
		$node->font = $node_conf["font"];
		$node->mass = $node_conf["host-mass"];

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
		$edge->width = $edge_conf["width"];
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
			$edge->width = $edge_conf["width"];
			array_push($data->edges, $edge);
		}	
	}
}

// add a line b/t the gateways
$edge = new Edge;
$edge->id=uniqid();
$edge->from = "gateway.ascot.khubla.lan";
$edge->to = "gateway.spring.khubla.lan";
$edge->color = "blue";
$edge->width = 2;
$edge->dashes = true;

array_push($data->edges, $edge);

$json = json_encode($data);
echo $json;


?>
