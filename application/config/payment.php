<?php

/**
 * Order types
 */
 
$config['orders'] = array
(
	'a' => array('credits' => 1, 'expiry' => FALSE, 'amount' => '3.50'),
	'b' => array('credits' => 5, 'expiry' => 2, 'amount' => '12.50'),
	'c' => array('credits' => 10, 'expiry' => 4, 'amount' => '19.50'),
	'd' => array('credits' => 30, 'expiry' => 6, 'amount' => '49.50'),
);

/**
 * SPPlus related configuration
 */
$config['spplus'] = array
(
	'servlet_url' => 'https://www.spplus.net/administration_distante/adminADistance.do',
	'payment_url' => 'https://www.spplus.net/paiement/init.do',
	'clent'       => '76 fb 33 d7 fb a0 c1 9a 2e 6c 86 c0 fa 9f c7 b1 1e c8 6c ff a1 31 5d f1',
	'codesiret'   => '50485777200017-001',
	'siret_short' => '50485777200017',
);	

/**
 * If enabled, payment gateway is skipped
 */

// $config['debug'] = extension_loaded('SPPLUS') ? FALSE : ! IN_PRODUCTION;
// $config['debug'] = TRUE;

/**
 * Admin email
 */

$config['admin_email'] = 'olty.grf.bmb@free.fr';

