<?php

class html extends html_Core {

	public static function print_attr($attr)
	{
		echo html::specialchars($attr);
	}

}