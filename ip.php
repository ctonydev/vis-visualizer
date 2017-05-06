<?php

function iplist($range)
{
	$addresses = array();
	@list($ip, $len) = explode('/', $range);

	if (($min = ip2long($ip)) !== false) {
	  $max = ($min | (1<<(32-$len))-1);
	  for ($i = $min; $i < $max; $i++)
	    $addresses[] = long2ip($i);
	}
	return $addresses;
}

?>