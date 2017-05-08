<?php
include_once("config.php");

function getSNMPSysName($ip) {
	global $snmp_community;

	return snmp2_get($ip, $snmp_community, "SNMPv2-MIB::sysName.0")."\n";
}

function getSNMPSysDesc($ip) {
	global $snmp_community;

	return snmp2_get($ip, $snmp_community, "SNMPv2-MIB::sysDescr.0")."\n";
}

?>



