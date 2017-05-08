<?php
include_once("config.php");

function getSNMPSysName($ip) {
	global $snmp_community;
	return snmp_value(snmp2_get($ip, $snmp_community, "SNMPv2-MIB::sysName.0"));
}

function getSNMPSysDesc($ip) {
	global $snmp_community;
	return snmp_value(snmp2_get($ip, $snmp_community, "SNMPv2-MIB::sysDescr.0"));
}

function snmp_value($v){
	$i = strpos($v, ":");
	if (false !=$i){
		return trim(substr($v,$i+1));
	}
	return false;

}

/*
* pass IP to query SMMP on and host to connect these interfaces to in the DB
*/
function getInterfaces($ip, $host) {
	global $snmp_community;

	$ret = array();

	$addresses =  snmp2_walk ($ip->ip, $snmp_community, "IP-MIB::ipAdEntAddr");
//	var_dump($addresses);
	$interfaceNumbers = snmp2_walk ($ip->ip, $snmp_community, "IP-MIB::ipAdEntIfIndex");
//	var_dump($interfaceNumbers);
	$netmasks = snmp2_walk ($ip->ip, $snmp_community, "IP-MIB::ipAdEntNetMask");
//	var_dump($netmasks);
	
	$interface_address =  array();
	$interface_masks =  array();

	for($i=0; $i<count($addresses);$i++){
		$interface_address[snmp_value($interfaceNumbers[$i])] = snmp_value($addresses[$i]);
		$interface_masks[snmp_value($interfaceNumbers[$i])] = snmp_value($netmasks[$i]);
	}
//	var_dump($interface_address);
//	var_dump($interface_masks);

	$interface_count = snmp_value(snmp2_get($ip->ip, $snmp_community, "IF-MIB::ifNumber.0"));
//	echo $interface_count."\n";
	for ( $i=1; $i<=$interface_count;$i++){
		$inter = new IFace;
		$inter->host = $host->sysname;
		$name = snmp_value(snmp2_get($ip->ip, $snmp_community, "IF-MIB::ifDescr.".$i));
//		echo ($name."\n");
		$index = snmp_value(snmp2_get($ip->ip, $snmp_community, "IF-MIB::ifIndex.".$i));
//		echo ($index."\n");
		$inter->index = $index;
		$inter->ip = $interface_address[$index];
		$inter->name = $name;
		$inter->mask = $interface_masks[$index];

//		var_dump($inter);
		array_push($ret, $inter);
	}

	return $ret;
}



?>



