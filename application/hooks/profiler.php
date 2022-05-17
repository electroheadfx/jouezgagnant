<?php

if (!IN_PRODUCTION) {
	Event::add('system.ready', 'init_profiler');
}

function init_profiler()
{
	// Fire_Profiler init
	$firephp = new Fire_Profiler;
	$firephp->log($_SERVER, 'Server Variables');
}