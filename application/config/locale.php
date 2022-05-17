<?php

// Array of locales your site is available in
$config['allowed_locales'] = array
(
	'en' => array('en_US', 'English_United States'),
	'fr' => array('fr_FR', 'French'),
);
				
// Long version of language (name of i18n folder)
$config['language'] = $config['allowed_locales']['fr'];

// Short version of language (for use in URLs)
$config['lang'] = 'fr';

$config['timezone'] = 'Europe/Paris';
// $config['timezone'] = 'America/New_York';
