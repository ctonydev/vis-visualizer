<?php
    include_once("config.php");
    include_once("lib/db.php");
    include_once("lib/snmp.php");
    include_once("domain/domain.php");

    $ips = getIps();

    foreach($ips as $ip) { {
        	echo "ip: ".$ip->ip." ";	
        	echo getSNMPSysName($ip->ip)." ".getSNMPSysDesc($ip->ip)."\n";
	    }
    }
?>

