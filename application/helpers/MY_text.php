<?php

class text extends text_Core {

	public static function zero_pad($str, $length)
	{
		return str_pad($str, $length, '0', STR_PAD_LEFT);
	}
		
	public static function in_regex_array($needle, $regex_arr)
	{
		foreach ($regex_arr as $regex)
		{
			$regex = str_replace('/', '\/', $regex);
			if (preg_match("/$regex/", $needle)) return TRUE;
		}
		return FALSE;
	}
}