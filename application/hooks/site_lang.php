<?php

// This hook sets the locale.language and locale.lang config values
// based on the language found in the first segment of the URL.

Event::add('system.routing', 'site_lang');
Event::add_before('system.404', array('Kohana', 'show_404'), 'site_lang');

function site_lang()
{
	// Array of allowed languages
	$locales = Kohana::config('locale.allowed_locales');
	
	// Check for a valid language, and redirect if not found
	$lang_found = preg_match('/^[a-zA-Z]{2}(\/|$)/', url::current());

	// Extract language from URL
	$lang = $lang_found ? strtolower(substr(url::current(), 0, 2)) : NULL;
	
	// Invalid language is given in the URL
	if ( ! array_key_exists($lang, $locales))
	{
		// Look for default alternatives and store them in order
		// of importance in the $new_langs array:
		//  1. cookie
		//  2. http_accept_language header
		//  3. default lang
		
		// Look for cookie
		$new_langs[] = (string) cookie::get('lang');
		
		// Look for HTTP_ACCEPT_LANGUAGE
		if (isset($_SERVER['HTTP_ACCEPT_LANGUAGE']))
		{
			foreach(explode(',', $_SERVER['HTTP_ACCEPT_LANGUAGE']) as $part)
			{
				$new_langs[] = substr($part, 0, 2);
			}
		}
		
		// Lowest priority goes to default language
		$new_langs[] = 'fr';
		
		// Now loop through the new languages and pick out the first valid one
		foreach (array_unique($new_langs) as $new_lang)
		{
			$new_lang = strtolower($new_lang);
			
			if (array_key_exists($new_lang, $locales))
			{
				$lang = $new_lang;
				break;
			}
		}
		
		// Redirect to URL with valid language
		url::redirect($lang.'/'.trim(substr(url::current(TRUE), $lang_found ? 2 : 0),'/'), 302, FALSE);
	}
	
	// Store locale config values
	Kohana::config_set('locale.lang', $lang);
	Kohana::config_set('locale.language', $locales[$lang]);
	
	// Overwrite setlocale which has already been set before in Kohana::setup()
	setlocale(LC_ALL, Kohana::config('locale.language').'.UTF-8');
	
	// Finally set a language cookie for 6 months
	cookie::set('lang', $lang, 15768000);
}