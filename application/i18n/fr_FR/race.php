<?php

$lang['adminedit'] = array
(
	'date' => array
	(
		'required' => 'requiert une date',
	),
	
	'time' => array
	(
		'required' => 'requiert un temps',
	),
	
	'spot' => array
	(
		'required' => 'requiert un hippodrome',
		'standard_text' => 'le nom de l\'hippodrome contient des caracteres invalides',
		'length' => 'l\'hippodrome doit comporter en tre 3 et 80 caracteres',
	),

	'pmu' => array
	(
		'required' => 'requiert pmu',
		'numeric' => 'pmu doit etre un numero',
	),

	'race' => array
	(
		'required' => 'requiert une course',
		'numeric' => 'numero de course',
	),

	'first' => array
	(
		'numeric' => 'la premiere selection doit etre un numero',
	),

	'second' => array
	(
		'numeric' => 'la deuxieme selection doit etre un numero',
	),

	'third' => array
	(
		'numeric' => 'la troisieme selection doit etre un numero',
	),

	'featured' => array
	(
		'default' => 'probleme de nom mentionne',
	),

	'horse' => array
	(
		'numeric' => 'le cheval doit etre un numero',
	),

	'horse_odds' => array
	(
		'numeric' => 'la cote du cheval doit etre un numero',
	),

	'profit_50' => array
	(
		'numeric' => 'le profit sur 50 doit etre un numero',
	),

	'profit_100' => array
	(
		'numeric' => 'le profit sur 100 doit etre un numero',
	),
);

$lang['admincreate'] = $lang['adminedit'];