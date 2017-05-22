<?php
	chdir(dirname(__FILE__));
    include_once("config.php");
    include_once("lib/db.php");
    include_once("lib/snmp.php");
    include_once("lib/domain/domain.php");
    include_once("lib/db/ipdb.php");

    date_default_timezone_set("UTC");
    echo date("l jS \of F Y h:i:s A\n");
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
	        	$interfaces = getInterfacesOnSNMPHost($ip, $host);
	        //	var_dump($interfaces);

	        	for ($i=0; $i<count($interfaces);$i++){
	        		$iface =$interfaces[$i];
	        		if (null != $iface->ip){
	        			if ("127.0.0.1" !=$iface->ip){
	        				saveInterface($iface);
	        			}
	        		}
	        	}
	        }
	    }
    }
?>
