<?php
    include_once("config.php");
    include_once("lib/db.php");
    include_once("lib/ping.php");
    include_once("lib/domain/domain.php");

    $ips = getIps();

    foreach($ips as $ip) { 
        echo "ip: ".$ip->ip."\n";
       	$time = ping($ip->ip);
        if (false !=$time) {
        	echo "ip: ".$ip->ip." time: ".$time."\n";
	        $ip->ping=$time;
	        $ip->laststatus=1;
            $ip->hostname = gethostbyaddr($ip->ip);
	        saveIp($ip);
	    } else {
            echo "ip: ".$ip->ip." down\n";
            $ip->laststatus=0;
            saveIp($ip);
        } 
    }
?>

