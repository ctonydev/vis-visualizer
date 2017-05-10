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

function tcp_conn($ip) {
	$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
	if ($socket === false) {
	    echo "socket_create() failed: reason: " . socket_strerror(socket_last_error()) . "\n";
	    return false;
	} else {
		$result = socket_connect($socket, $address, $service_port);
		if ($result === false) {
			return false;
		} else {
		    return true;
		}
		socket_close($socket);
	}
}
?>

