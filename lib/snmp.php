<?php
include_once("config.php");

function getSNMPSysName($ip) {
	global $snmp_community;

	return snmp2_get($ip, $snmp_community, ".1.3.6.1.2.1.1.5.0")."\n";
}

?>



