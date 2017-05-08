<?php
include_once("config.php");

function getSNMPSysName($ip) {
	global $snmp_community;

	return snmp2_get($ip, $snmp_community, "SNMPv2-MIB::sysName.0");
}

function getSNMPSysDesc($ip) {
	global $snmp_community;

	return snmp2_get($ip, $snmp_community, "SNMPv2-MIB::sysDescr.0");
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

	$interface_count = snmp_value(snmp2_get($ip->ip, $snmp_community, "IF-MIB::ifNumber.0"));
	echo $interface_count."\n";
	for ( $i=1; $i<=$interface_count;$i++){
		$inter = new IFace;
		$inter->host = $host->sysname;
		$name = snmp_value(snmp2_get($ip->ip, $snmp_community, "IF-MIB::ifDescr.".$i))."\n";
		echo ($name);
		$inter->ip = snmp_value(snmp2_get($ip->ip, $snmp_community, "IF-MIB::ifDescr.".$i));
		$inter->name = snmp_value(snmp2_get($ip->ip, $snmp_community, "IF-MIB::ifDescr.".$i));
		$inter->mask = snmp_value(snmp2_get($ip->ip, $snmp_community, "IF-MIB::ifDescr.".$i));
	}
}

?>



