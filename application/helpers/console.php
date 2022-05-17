<?php

class console_Core {
	
	public static function log($msg)
	{
		if ( ! IN_PRODUCTION)
		{
			Fire_Profiler::getInstance()->fb($msg, FirePHP::LOG);
		}
	}
	
}