<?php

include_once("lib/db.php");

/*
* get node name
*/
function getNodeName($ip){
	if (null!=$ip->hostname){
		return $ip->hostname;
	}
	return $ip->ip;

}

/*
* for every network we know about, find the router ip
*/
function mapNetworksToRouterNodes(){

}
?>



