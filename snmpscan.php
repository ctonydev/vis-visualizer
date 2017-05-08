<?php
    include_once("config.php");
    include_once("lib/db.php");
    include_once("lib/snmp.php");
    include_once("domain/domain.php");

    $ips = getIps();

    foreach($ips as $ip) { {
        	echo "ip: ".$ip->ip."\n";
        	$sysname = getSNMPSysName($ip->ip);
        	if (false!=$sysname){
	        	$host = new Host;
	        	$host->sysname = trim($sysname);
	        	$sysdesc = getSNMPSysDesc($ip->ip);
	        	if (false !=$sysdesc){
	        		$host->sysdesc = trim($sysdesc);
	        	}
	        	saveHost($host);

	        	eraseInterfaces($host);
	        	$interfaces = getInterfaces($ip, $host);
	        //	var_dump($interfaces);

	        	for ($i=0; $i<count($interfaces);$i++){
	        		saveInterface($interface[$i]);

	        	}
	        }
	    }
    }
?>

