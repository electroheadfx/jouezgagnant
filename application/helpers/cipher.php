<?php

/**
 * Most of this class taken from the Auth module
 */

class cipher_Core
{
	public static function split_salt()
	{
		return preg_split('/,\s*/', Kohana::config('cipher.salt_pattern'));
	}

	/**
	 * Creates a hashed password from a plaintext password, inserting salt
	 * based on the configured salt pattern.
	 *
	 * @param   string  plaintext password
	 * @return  string  hashed password string
	 */
	public static function hash_password($password, $salt = FALSE)
	{
		$salt_pattern = self::split_salt();
		
		if ($salt === FALSE)
		{
			// Create a salt seed, same length as the number of offsets in the pattern
			$salt = substr(self::hash(uniqid(NULL, TRUE)), 0, count($salt_pattern));
		}

		// Password hash that the salt will be inserted into
		$hash = self::hash($salt.$password);

		// Change salt to an array
		$salt = str_split($salt, 1);

		// Returned password
		$password = '';

		// Used to calculate the length of splits
		$last_offset = 0;

		foreach ($salt_pattern as $offset)
		{
			// Split a new part of the hash off
			$part = substr($hash, 0, $offset - $last_offset);

			// Cut the current part out of the hash
			$hash = substr($hash, $offset - $last_offset);

			// Add the part to the password, appending the salt character
			$password .= $part.array_shift($salt);

			// Set the last offset to the current offset
			$last_offset = $offset;
		}

		// Return the password, with the remaining hash appended
		return $password.$hash;
	}

	/**
	 * Perform a hash, using the configured method.
	 *
	 * @param   string   string to hash
	 * @return  string
	 */
	protected static function hash($str)
	{
		return hash(Kohana::config('cipher.hash_method'), $str);
	}

	/**
	 * Finds the salt from a password, based on the configured salt pattern.
	 *
	 * @param   string  hashed password
	 * @return  string
	 */
	public static function find_salt($password)
	{
		$salt = '';
		
		foreach (self::split_salt() as $i => $offset)
		{
			// Find salt characters... take a good long look..
			$salt .= substr($password, $offset + $i, 1);
		}

		return $salt;
	}
}

?>