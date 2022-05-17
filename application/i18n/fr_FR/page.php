<?php

$lang['admincreate'] = array
(
	'name' => array
	(
		'required' => 'requiert un nom de page',
		'alpha_dash' => 'la page contient des caract&egrave;res non valide',
		'length' => 'la page doit comporter entre 4 et 40 caract&egrave;res',
		'default' => 'un probl&egrave;me est survenu avec le nom de la page',
	),
	
	'title' => array
	(
		'required' => 'requiert un titre',
		'standard_text' => 'le titre contient des caract&egrave;res invalides',
		'length' => 'le titre doit comporter entre 3 et 80 caract&egrave;res',
		'default' => 'probl&egrave;me avec le nom de dossier',
	),
	
	'content' => array
	(
		'required' => 'requiert un contenu',
		'default' => 'le contenu du dossier a un probl&egrave;me',
	),
	
	'language' => array
	(
		'required' => 'requiert un language',
		'language' => 'le language doit etre en francais',
		'default' => 'probl&egrave;me avec le language',
	),
	
	'active' => array
	(
		'default' => 'probl&egrave;me avec le dossier actif',
	),
);

$lang['adminedit'] = $lang['admincreate'];