<?php
    chdir(dirname(__FILE__));
    include_once("config.php");
    include_once("lib/db.php");
    include_once("lib/ping.php");
    include_once("lib/arp.php");
    include_once("lib/domain/domain.php");

    $ips = getNetworkIps();

    foreach($ips as $ip) {
        $found = tcp_conn($ip, 62078);
    	
        if (true==$found) {
        	echo "ip: ".$ip."\n";
	        $ipObj = new Ip();
	        $ipObj->ip=$ip;
	        $ipObj->ping=0;
	        $ipObj->laststatus=1;
            $ipObj->hostname = gethostbyaddr($ip);
            $ipObj->source = "ios";
	        saveIp($ipObj);
	    }
    }

function tcp_conn($ip, $service_port) {
	$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
	if ($socket === false) {
	    echo "socket_create() failed: reason: " . socket_strerror(socket_last_error()) . "\n";
	    return false;
	} else {
		$result = socket_connect($socket, $ip, $service_port);
		if ($result === false) {
			return false;
		} else {
		    return true;
		}
		socket_close($socket);
	}
}
?>

