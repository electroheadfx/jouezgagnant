<?php 

/**
 * Had to extend this helper to hook into the redirect
 */
class url extends url_Core
{
	/**
	 * Language aware site url
	 *
	 * @param   string
	 * @param   string
	 * @param   bool|string
	 * @return  string  URL string
	 */
	public static function site($uri = '', $protocol = FALSE, $lang = TRUE)
	{
		if ($lang === TRUE)
		{
			$lang = Kohana::config('locale.lang');
		}
		
		if ($lang !== FALSE && !preg_match("/:\/\/[^\/]+\/[a-z]{2}\//", $uri) && !preg_match("/^\/?[a-z]{2}\//", $uri))
		{
			$uri = $lang.'/'.trim($uri, '/');
		}
		
		return parent::site($uri, $protocol);
	}

	/**
	 * Sends a page redirect header. Saves user messages to session.
	 *
	 * @param  mixed   string site URI or URL to redirect to, or array of strings if method is 300
	 * @param  string  HTTP method of redirect, or null for 302
	 * @param  bool|string Language, or TRUE if we want to use the default language
	 * @return void
	 */
	public static function redirect($uri = '', $method = '302', $lang = FALSE)
	{
		if (Kohana::$instance)
		{
			$session    = Session::instance();
			$controller = Kohana::instance();
			
			$session->set('user_messages', $controller->user_messages);
			$session->set('user_message_success', $controller->user_message_success);
		
			/*	
			if (Kohana::config('site.redirect_debug'))
			{
				Fire_Profiler::getInstance()->render();
				
				$view = new View('redirect_debug');
				$view->uri = $uri;
				$view->render(TRUE);
				exit;
			}
			*/
			
			if (!IN_PRODUCTION) {
				Fire_Profiler::getInstance()->render();
			}
		}
	
		// language-aware redirect		
		if ($lang === TRUE)
		{
			$lang = Kohana::config('locale.lang');
		}
		if ($lang !== FALSE)
		{
			$uri = $lang.'/'.trim($uri, '/');
		}

		if (!$method)
		{
			$method = 302;
		}

		parent::redirect($uri, $method ? $method : '302');
		die("redirect to $uri failed, headers already sent");
	}
	
	/**
	 * Language-aware current url
	 *
	 * @param   bool  Query string returned?
	 * @param   bool|string Do we want to have the language portion returned?
	 * @return  string  Current url
	 */
	public static function current($qs = FALSE, $lang = FALSE)
	{
		return $lang ? substr(parent::current($qs), 3) : parent::current($qs);
	}
	
	public static function site_lang($uri = '', $protocol = FALSE)
	{
		return self::site($uri, $protocol, TRUE);
	}

	public static function redirect_lang($uri = '', $method = '302')
	{
		self::redirect($uri, $method, FALSE);
	}

	public static function current_lang($qs = FALSE)
	{
		return self::current($qs, TRUE);
	}

}