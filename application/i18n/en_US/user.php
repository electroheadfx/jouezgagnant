<?php

$lang['login'] = array
(
	'email' => array
	(
		'required' => 'Please enter your email',
	),

	'password' => array
	(
		'required' => 'Please enter your password',
	),
);

$lang['create'] = array
(
	'email' => array
	(
		'user_email_free' => 'This email is already in use',
		'required' => 'Email is required',
		'email' => 'That is not a valid email',
		'length' => 'Email must be between 5 and 50 characters',
		'default' => 'There is a problem with the email field',
	),

	'first_name' => array
	(
		'required' => 'First name is required',
		'length' => 'First name must be between 2 and 40 characters',
		'standard_text' => 'First name contains invalid characters',
		'default' => 'There is a problem with the first name field',
	),

	'last_name' => array
	(
		'required' => 'Last name is required',
		'length' => 'Last name must be between 2 and 40 characters',
		'standard_text' => 'Last name contains invalid characters',
		'default' => 'There is a problem with the last name field',
	),
	
	'address' => array
	(
		'required' => 'Address is required',
		'length' => 'Address must be between 4 and 50 characters',
		'default' => 'There is a problem with the address field',
	),
	
	'address2' => array
	(
		'length' => 'Additional address must be between 5 and 50 characters',
		'default' => 'There is a problem with the additional address field',
	),

	'city' => array
	(
		'required' => 'City is required',
		'length' => 'City must be between 1 and 15 characters',
		'standard_text' => 'City contains invalid characters',
		'default' => 'There is a problem with the city field',
	),

	'postal_code' => array
	(
		'required' => 'Postal code is required',
		'length' => 'Postal code must be between 3 and 15 characters',
		'alpha_numeric' => 'Postal code contains invalid characters',
		'default' => 'There is a problem with the postal code field',
	),

	'password_confirm' => array
	(
		'matches' => 'Passwords do not match',
	),

	'birth_date' => array
	(
		'invalid_date' => 'Your birth date is not a valid date',
	),
);

$lang['edit'] = $lang['create'];
$lang['adminedit'] = $lang['create'];
$lang['admincreate'] = $lang['create'];

