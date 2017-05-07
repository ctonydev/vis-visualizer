<?

function getMAC($ip) {
	$mac_string = shell_exec("arp -a $ip");
	$mac_array = explode(" ",$mac_string);
	$mac = $mac_array[3];
	return $mac;
}
?>