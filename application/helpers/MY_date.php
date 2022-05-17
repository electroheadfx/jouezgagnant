<?php

class date extends date_Core {
	
	public static function reformat($format, $date = 'now')
	{
		return date_format(date_create($date), $format);
	}

	public static function reformat_std($date = 'now', $sep = '/')
	{
		return date::reformat('m'.$sep."d".$sep."Y", $date);
	}
	
	public static function reformat_datetime($date = 'now')
	{
		return date::reformat('Y-m-d H:i:s', $date);
	}
	
	public static function reformat_readable($date = 'now')
	{
		return date::reformat('M j, Y', $date);
	}
	
	public static function reformat_short($date = 'now')
	{
		return date::reformat('j/m/Y', $date);
	}
	
	public static function reformat_time($date = 'now')
	{
		return date::reformat('G:i', $date);
	}
	
	public static function reformat_from_timezone($date = 'now', $format, $timezone)
	{
		$d = new DateTime($date . " " . $timezone);
		$tz = new DateTimeZone(Kohana::config('locale.timezone'));
		$d->setTimezone($tz);
		return $d->format($format);
	}

	public static function reformat_to_timezone($date = 'now', $format, $timezone)
	{
		$d = new DateTime($date . " " . Kohana::config('locale.timezone'));
		$tz = new DateTimeZone($timezone);
		$d->setTimezone($tz);
		return $d->format($format);
	}
	
	public static function date_in_language($date = 'now', $format)
	{
		$l = Kohana::config('locale.language');
		setlocale(LC_TIME, $l[0]);
		$date = strtotime($date);
		$p = strftime($format, $date);
		$pu = utf8_decode($p);
		if (!IN_LOCAL) {
			$puh = htmlentities($p);
		} else {
			$puh = htmlentities($pu);
		}
		$puc = ucwords($puh);
		return $puc;
	}
}