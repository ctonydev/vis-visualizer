<?php

// GRANT ALL PRIVILEGES ON netvis.* TO 'netvis'@'localhost' identified by 'netvis';
//  mysqldump -d -u root netvis > netvis.sql

$db = array();
$db["servername"] = "localhost";
$db["username"]= "netvis";
$db["password"] = "netvis";
$db["dbname"] = "netvis";

$snmp_community="public";

?>
