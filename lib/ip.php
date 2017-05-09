<?php

function iplist($range){
	@list($ip, $len) = explode('/', $range);

	if (($min = ip2long($ip)) !== false) {
	  $max = ($min | (1<<(32-$len))-1);
	  for ($i = $min; $i < $max; $i++)
	    $addresses[] = long2ip($i);
	}
	return $addresses;
}

/*
* http://stackoverflow.com/questions/594112/matching-an-ip-to-a-cidr-mask-in-php-5
*/
function cidr_match($ip, $range){
    list ($subnet, $bits) = explode('/', $range);
    $ip = substr(IP2bin($ip),0,$bits) ;
    $subnet = substr(IP2Bin($subnet),0,$bits) ;
    return ($ip == $subnet) ;
}

function IP2Bin($ip){
    $ips = explode(".",$ip) ;
    foreach ($ips as $iptmp){
        $ipbin .= sprintf("%08b",$iptmp) ;
    }
    return $ipbin ;
}

// http://php.net/manual/en/function.ip2long.php
function mask2cidr($mask){
  $long = ip2long($mask);
  $base = ip2long('255.255.255.255');
  return 32-log(($long ^ $base)+1,2);

  /* xor-ing will give you the inverse mask,
      log base 2 of that +1 will return the number
      of bits that are off in the mask and subtracting
      from 32 gets you the cidr notation */
        
}

?>