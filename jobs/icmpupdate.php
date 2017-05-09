<?php
    include_once("config.php");
    include_once("lib/db.php");
    include_once("lib/ping.php");
    include_once("domain/domain.php");

    $ips = getIps();

    foreach($ips as $ip) { 
       	$time = ping($ip);
        echo "ip: ".$ip->ip."\n";
        if (false !=$time) {
        	echo "ip: ".$ip." time: ".$time."\n";
	        $ipObj = new Ip();
	        $ipObj->ip=$ip;
	        $ipObj->ping=$time;
	        $ipObj->laststatus=1;
            $ipObj->hostname = gethostbyaddr($ip);

//	        saveIp($ipObj);
	    }   
    }
?>

