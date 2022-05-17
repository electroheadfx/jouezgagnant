<?php

/**
 * Simple access control, sorted into logged in and not logged in pages
 * Pages are defined as controller/method 
 */

$config['li_pages'] = array
(
	'account/index',
	'account/edit',
	'account/logout',
	'subscriptions/order',
	'subscriptions/agree',
	'subscriptions/confirm',
	'subscriptions/send',
	'subscriptions/process',
	'predictions/.*',
);

$config['nli_pages'] = array
(
	'home/*',
	'entry/index',
	'intro/index',
	'info/index',
	'info/resultats1',
	'info/resultats2',
	'info/jouez',
	'account/login',
	'account/create',
	'subscriptions/index',
	'pages/.*',
	'admin/.*',
);
