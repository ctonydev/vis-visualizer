<?php

// GRANT ALL PRIVILEGES ON netvis.* TO 'netvis'@'localhost' identified by 'netvis';
//  mysqldump -d -u root netvis > netvis.sql

$db = array();
$db["servername"] = "localhost";
$db["username"]= "netvis";
$db["password"] = "netvis";
$db["dbname"] = "netvis";

$snmp = array();
$snmp["community"]="public";

$colors = array();
$colors["up-router"]="rgb(229,164,255)";
$colors["down-router"]="rgb(164,164,164)";
$colors["up-host"]="rgb(229,164,67)";
$colors["down-host"]="rgb(164,164,164)";
$colors["up-edge"]="rgb(0,0,0)";
$colors["down-edge"]="rgb(164,164,164)";

?>
