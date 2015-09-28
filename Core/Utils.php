<?php

namespace Core;

class Utils {
	const LOAD_FACTOR = 10;
	const SALT_LENGTH = 14;

	private static function cryptoRandSecure($min, $max)
	{
	    $range = $max - $min;
	    if ($range < 1) return $min;
	    $log = ceil(log($range, 2));
	    $bytes = (int) ($log / 8) + 1;
	    $bits = (int) $log + 1;
	    $filter = (int) (1 << $bits) - 1;
	    do {
	        $rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes)));
	        $rnd = $rnd & $filter;
	    } while ($rnd >= $range);
	    return $min + $rnd;
	}

	public static function getToken($length)
	{
	    $token = "";
	    $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
	    $codeAlphabet.= "abcdefghijklmnopqrstuvwxyz";
	    $codeAlphabet.= "0123456789";
	    $max = strlen($codeAlphabet) - 1;
	    for ($i=0; $i < $length; $i++) {
	        $token .= $codeAlphabet[self::cryptoRandSecure(0, $max)];
	    }
	    return $token;
	}

	public static function verifyHash($candidate, $hash) {
		$salt = substr($hash, 0, self::SALT_LENGTH);
		$digest = $candidate . $salt;

		for ($i = 0; $i < self::LOAD_FACTOR; $i++) { 
			$digest = md5($digest);
		}
		
		return $salt . $digest == $hash;
	}

	public static function digestPass($password) {
		$salt = self::getToken(self::SALT_LENGTH);
		$digest = $password . $salt;

		for ($i = 0; $i < self::LOAD_FACTOR; $i++) { 
			$digest = md5($digest);
		}

		return $salt . $digest;
	}
}

?>