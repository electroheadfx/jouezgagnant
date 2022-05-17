<?php 

class valid extends valid_Core
{
	/**
	 * Checks if a user email is free
	 *
	 * @param   string   Email to check
	 * @param   string   String or array of emails that are considered ok
	 * @return  bool
	 */
	public static function user_email_free($email, $exempt = array())
	{
		if (!is_array($exempt)) $exempt = array($exempt);
		
		foreach ((array) $exempt as $exempt_email)
		{
			if ($email == $exempt_email) return TRUE;
		}
		
		return ! User_Model::email_exists($email);
	}
	
	public static function user_admin_email_free($email)
	{
		if (isset(Kohana::$instance->view->edit->email))
		{
			return self::user_email_free($email, Kohana::$instance->view->edit->email);
		}
		else
		{
			return self::user_email_free($email);
		}
	}
	
	public static function assemble_date(Validation $valid, $field)
	{
		if (array_key_exists($field, $valid->errors()))
			return;
 
		$mon   = $field."_month";
		$day   = $field."_day";
		$year  = $field."_year";
		
		$mon   = text::zero_pad($valid->$mon, 2);
		$day   = text::zero_pad($valid->$day, 2);
		$year  = $valid->$year;
		
		if (checkdate($mon, $day, $year))
		{
			$valid->$field = "$year-$mon-$day";
		}
		else
		{
			$valid->add_error($field, 'invalid_date');
		}
	}
	
	public static function post_unset(Validation $valid, $field)
	{
		unset($valid->$field);
	}

	/**
	 * Checks if a language code is valid
	 * @param   string  Language
	 * @return  bool
	 */
	public static function language($lang)
	{
		return Kohana::config("locale.allowed_locales.$lang");
	}
	
	/**
	 * Determins is this is a valid value for a checkbox
	 */
	public static function checkbox($value)
	{
		return $value == "on";
	}
	
	public static function boolify($value)
	{
		return (bool) $value;
	}
	
	/**
	 * Combine a date and a time input into a mysql datetime
	 */
	public static function combine_datetime(Validation $valid, $field)
	{
		$valid->$field = date::reformat_datetime("$valid->date $valid->time");
	}
	
	/**
	 * Combine a date and time and handle timezone change to server
	 */
	public static function combine_adjust_timezone(Validation $valid, $field)
	{
		$valid->$field = date::reformat_from_timezone("$valid->date $valid->time", 'Y-m-d H:i:s', Kohana::$instance->user->timezone);
	}
	
	/**
	 * Combine two named fields into a valid mysql datetime, handling timezone
	 */
	public static function merge_to_datetime(Validation $valid, $field)
	{
		$input = $valid->$field;
		$t = $valid->day_open;
		console::log("Input ({$field} | {$t}): {$input}");
		$output = date::reformat_from_timezone("$valid->date $input", 'Y-m-d H:i:s', Kohana::$instance->user->timezone);
		console::log("Output: {$output}");
		$valid->$field = $output;
	}
	
}
