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
* get router nodes (hosts that have more than one ip)
*/
function getRouterHosts() {
	$ret = array();
	$hosts = getAllHosts();
	for ($i=0; $i<count($hosts);$i++){
		$host =$hosts[$i];
	//	var_dump($host);
		$interfaces = getInterfaces($host);
	//	var_dump($interfaces);
		if (false!=$interfaces){
			if (count($interfaces)>1){
			$ret[$host->sysname]=$host;
			}
		}
	}
	return $ret;
}

/*
* is router ip?
*/
function isRouterIp($ip){
	$hostname = getHostNameByIP($ip);
	return (false !=$hostname);
}
?>



