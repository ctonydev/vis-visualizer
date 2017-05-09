<?php

include_once("lib/db.php");

/*
* get node name
*/
function getNodeName($ip){
	if (null!=$ip->hostname){
		if($ip->hostname != $ip->ip){
			$ret = shortname($ip->hostname);
			return $ret;
		}
	}
	return $ip->ip;
}

function shortname($name){
	return substr($name, 0, strpos($name, '.'));
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

/*
* get the appropriate router for the ip
*/
function getRouterForIp($ip){
	$interfaces = getAllInterfaces();
	foreach ($interfaces as $interface){
		$range = $interface->ip."/".mask2cidr($interface->mask)."\n";
		if (true==cidr_match($ip->ip, $range)){
			return $interface->host;
		}
	}
}
?>



