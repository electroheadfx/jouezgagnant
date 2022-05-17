<?php

$lang['login'] = array
(
	'email' => array
	(
		'required' => 'veuillez entrer votre email',
	),

	'password' => array
	(
		'required' => 'veuillez entrer votre mot de passe',
	),
);

$lang['create'] = array
(
	'email' => array
	(
		'user_email_free' => 'cet email est deja utilise',
		'required' => 'requiert un email',
		'email' => 'email invalide',
		'length' => 'l\'email doit comporter entre 5 et 50 caracteres',
		'default' => 'il y a un probleme avec l\'email',
	),

	'first_name' => array
	(
		'required' => 'requiert un prenom',
		'length' => 'le prenom doit comporter entre 2 et 40 caracteres',
		'standard_text' => 'le prenom contient des caracteres invalides',
		'default' => 'il y a un probleme avec le prenom',
	),

	'last_name' => array
	(
		'required' => 'requiert un nom',
		'length' => 'le nom doit comporter entre 2 et 40 caracteres',
		'standard_text' => 'Le nom contient des caracteres invalides',
		'default' => 'il y a un probleme avec le nom',
	),
	
	'address' => array
	(
		'required' => 'requiert une adresse',
		'length' => 'l\'adresse doit comporter entre 4 et 50 caracteres',
		'default' => 'il y a un probleme avec l\'adresse',
	),
	
	'address2' => array
	(
		'length' => 'l\'adresse additionelle doit comporter entre 5 et 50 caracteres',
		'default' => 'il y a un probleme avec l\'adresse additionelle',
	),

	'city' => array
	(
		'required' => 'requiert une ville',
		'length' => 'la ville doit comporter entre 4 et 50 caracteres',
		'standard_text' => 'la ville contient de caracteres invalides',
		'default' => 'il y a un probleme avec le nom de la ville',
	),

	'postal_code' => array
	(
		'required' => 'requiert un code postal',
		'length' => 'le code postal doit comporter entre 3 et 15 caracteres',
		'alpha_numeric' => 'le code postal contient des caracteres invalides',
		'default' => 'il y a un probleme avec le code postal',
	),

	'password_confirm' => array
	(
		'matches' => 'le mot de passe de correspond pas',
	),

	'birth_date' => array
	(
		'invalid_date' => 'votre date de naissance est invalide',
	),
);

$lang['edit'] = $lang['create'];
$lang['adminedit'] = $lang['create'];
$lang['admincreate'] = $lang['create'];

