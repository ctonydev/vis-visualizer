<?php
    include_once("config.php");
    include_once("lib/db.php");
    include_once("lib/ping.php");
    include_once("lib/arp.php");
    include_once("lib/domain/domain.php");

    $ips = getNetworkIps();

    foreach($ips as $ip) {
        $time = ping($ip);
        if (false !=$time) {
        	echo "ip: ".$ip." time: ".$time."\n";
	        $ipObj = new Ip();
	        $ipObj->ip=$ip;
	        $ipObj->ping=$time;
	        $ipObj->laststatus=1;
            $ipObj->hostname = gethostbyaddr($ip);

	        saveIp($ipObj);

//            $mac = getMAC($ip);
 //           echo $mac;
	    }
    }
?>

