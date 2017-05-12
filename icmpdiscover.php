<?php
    chdir(dirname(__FILE__));
    include_once("config.php");
    include_once("lib/db.php");
    include_once("lib/ping.php");
    include_once("lib/arp.php");
    include_once("lib/domain/domain.php");

    date_default_timezone_set("UTC");
    echo date("l jS \of F Y h:i:s A\n");
    $ips = getNetworkIps();

    foreach($ips as $ip) {
        $time = ping($ip);
        if (false !=$time) {
            $hostname = gethostbyaddr($ip);
        	echo "ip: ".$ip." (".$hostname.") ping time(s): ".$time."\n";
	        $ipObj = new Ip();
	        $ipObj->ip=$ip;
	        $ipObj->ping=$time;
	        $ipObj->laststatus=1;
            $ipObj->hostname = $hostname;
            $ipObj->source="icmp";

	        saveIp($ipObj);
	    }
    }
?>

