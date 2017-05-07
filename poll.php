<?php
    include("config.php");
    include("lib/db.php");
    include("lib/ping.php");

    $ips = getNetworkIps();

    foreach($ips as $ip) {
        $time = ping($ip);
        echo "ip: ".$ip." time: ".$time."\n";
    }
?>

