<?php
    chdir(dirname(__FILE__));
    include_once("config.php");
    include_once("lib/db.php");
    include_once("lib/ping.php");
    include_once("lib/domain/domain.php");

    date_default_timezone_set("UTC");
    echo date("l jS \of F Y h:i:s A\n");
    $ips = getIps();


    foreach($ips as $ip) { 
       // echo "ip: ".$ip->ip."\n";
       	$time = ping($ip->ip);
        if (false !=$time) {
            $host = gethostbyaddr($ip->ip);
        	echo "ip: ".$ip->ip." (".$host.") time: ".$time."\n";
	        $ip->ping=$time;
	        $ip->laststatus=1;
            $ip->hostname = $host;
	        saveIp($ip);
	    } else {
            echo "ip: ".$ip->ip." down\n";
            $ip->laststatus=0;
            saveIp($ip);
        } 
    }
?>

